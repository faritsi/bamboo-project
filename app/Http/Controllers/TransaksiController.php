<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use App\Models\TransaksiMidtrans;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\SendMessageWhatsAppService;
use App\Models\Ingpo;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $midtransService;
    protected $whatsappService;

    public function __construct(MidtransService $midtransService, SendMessageWhatsAppService $whatsappService)
    {
        $this->midtransService = $midtransService;
        $this->whatsappService = $whatsappService;
    }

    public function view_tf(Request $request)
    {
        $user = Auth::user();
        $produk = Produk::all();
        $kategori = Kategori::all();
        $transaksi = Transaksi::all();



        // Default date range: Last 7 days if no input is provided
        $startDate = $request->input('startDate')
            ? Carbon::parse($request->input('startDate'))->startOfDay()
            : Carbon::now()->subDays(7)->startOfDay();

        $endDate = $request->input('endDate')
            ? Carbon::parse($request->input('endDate'))->endOfDay()
            : Carbon::now()->endOfDay();



        // Build the query
        $tfQuery = Transaksi::query();

        // Filter by date range
        $tfQuery->whereBetween('created_at', [$startDate, $endDate]);

        // Filter by category if provided
        if ($request->input('pilihKategori') && $request->input('pilihKategori') != 'semuaKategori') {
            $selectedKategori = Kategori::where('name', $request->input('pilihKategori'))->first();
            if ($selectedKategori) {
                $tfQuery->where('kategori_id', $selectedKategori->id);
            }
        }

        // Filter by product if provided
        if ($request->input('pilihProduk') && $request->input('pilihProduk') != 'semuaProduk') {
            $tfQuery->where('nama_produk', $request->input('pilihProduk'));
        }

        // Fetch filtered transactions
        $tf = $tfQuery->get();

        // Prepare sales data for the chart
        $sales = $tfQuery->selectRaw('DATE(created_at) as sale_date, nama_produk, SUM(qty) as total_sold')
            ->groupBy('sale_date', 'nama_produk')
            ->orderBy('sale_date', 'asc')
            ->get();

        $salesData = $sales->map(function ($item) {
            return [
                'product' => $item->nama_produk,
                'totalSold' => $item->total_sold,
                'saleDate' => Carbon::parse($item->sale_date)->format('d M Y'),
            ];
        });

        $groupedTransactions = $tf->groupBy('order_id');


        // Pass data to the view
        return view('admin.transaksi', [
            'title' => 'Penjualan',
            'salesData' => $salesData,
            'startDate' => $startDate->format('Y-m-d'), // Pass formatted start date
            'endDate' => $endDate->format('Y-m-d'),    // Pass formatted end date
        ], compact('produk', 'user', 'kategori', 'tf', 'transaksi', 'groupedTransactions'));
    }



    public function createTransaction(Request $request)
    {
        try {
            $gen_id_order = 'ORDER-' . rand();

            // Validate the incoming request
            $validated = $request->validate([
                'pembayaran' => 'required|numeric',
                'products' => 'required|array', // Ensure products is an array
                'products.*.id' => 'required|string',
                'products.*.name' => 'required|string',
                'products.*.quantity' => 'required|numeric',
                'products.*.price' => 'required|numeric',
                'products.*.kategori_id' => 'required|numeric',
                'name' => 'required|string',
                'alamat' => 'required|string',
                'city' => 'required|string',
                'pos' => 'required|string',
                'nohp' => 'required|string',
                'cost' => 'required|numeric',
                'kode_produk' => 'required|exists:produks,kode_produk', // Validasi berdasarkan kode_produk
                // 'kategori_id' => 'required|exists:kategoris,id', // Memastikan kategori ada
                'courier' => 'required|string',
                'courier_service' => 'required|string',
            ]);

            Log::info('Transaction Status Updated: ', [
                "PRODUCT" => $validated,
            ]);



            // Iterasi melalui setiap produk dan simpan transaksi per produk
            foreach ($validated['products'] as $product) {
                $transaksi = new Transaksi([
                    'order_id' => $gen_id_order,
                    'kode_produk' => $validated['kode_produk'],
                    'kategori_id' => $product['kategori_id'],
                    'total_pembayaran' => $validated['pembayaran'], // Total pembayaran tetap sama untuk semua
                    'nama_produk' => $product['name'], // Nama produk dari array products
                    'qty' => $product['quantity'], // Jumlah dari produk
                    'harga' => $product['price'], // Harga dari produk
                    'name' => $validated['name'],
                    'nohp' => $validated['nohp'],
                    'alamat' => $validated['alamat'],
                    'pos' => $validated['pos'],
                    'city' => $validated['city'],
                    'courier' => $validated['courier'],
                    'courier_service' => $validated['courier_service'],
                    'status' => 'capture'
                ]);

                Log::info('Data transaksi yang akan disimpan:', $transaksi->toArray());

                // Simpan transaksi
                $transaksi->save();
            }

            // Add shipping cost (ongkir) as a separate item in the Midtrans payload
            $itemDetails = [];
            foreach ($validated['products'] as $product) {
                $itemDetails[] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                ];
            }

            // Add shipping cost as an item
            $itemDetails[] = [
                'id' => 'ongkir',
                'name' => 'Ongkir',
                'quantity' => 1,
                'price' => $validated['cost'],
            ];

            // Set up Midtrans configuration
            Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-9zcBME8uz3JAPNkLONOYiCEa');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Prepare Midtrans transaction details
            $params = [
                'transaction_details' => [
                    'order_id' => $gen_id_order,
                    'gross_amount' => $validated['pembayaran'], // The total payment amount
                ],
                'item_details' => $itemDetails, // The array of products with quantities and prices
                'customer_details' => [
                    'first_name' => $validated['name'],
                    'phone' => $validated['nohp'],
                    'address' => $validated['alamat'],
                    'postal_code' => $validated['pos'],
                    "billing_address" => [
                        'first_name' => $validated['name'],
                        'phone' => $validated['nohp'],
                        'address' => $validated['alamat'],
                        'postal_code' => $validated['pos'],
                    ],
                    "shipping_address" => [
                        'first_name' => $validated['name'],
                        'phone' => $validated['nohp'],
                        'address' => $validated['alamat'],
                        'city' => $validated['city'],
                        'postal_code' => $validated['pos'],
                        'country_code' => 'IDN'
                    ]
                ],
                'callbacks' => [
                    'finish' => url('/catalog')
                ]
            ];

            // Generate Snap token
            $snapToken = Snap::getSnapToken($params);

            // Return Snap token for the frontend to trigger payment
            return response()->json([
                'snap_token' => $snapToken
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating transaction: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Something went wrong. TEASDASKDJ'], 500);
        }
    }


    public function index()
    {
        $transactions = $this->midtransService->getAllStoredTransactions();

        // Optionally, update transaction statuses from Midtrans
        foreach ($transactions as $transaction) {
            $status = $this->midtransService->getTransactionStatus($transaction->order_id);
            if ($status) {
                // Update your transaction record with the latest status
                \DB::table('transaksis')
                    ->where('order_id', $transaction->order_id)
                    ->update(['status' => $status->transaction_status]);
            }
        }

        // Fetch updated transactions
        $transactions = $this->midtransService->getAllStoredTransactions();

        return view('admin.transaksi', compact('transactions'));
    }

    public function notificationHandler(Request $request)
    {
        try {
            // Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-9zcBME8uz3JAPNkLONOYiCEa');
            Config::$isProduction = false; // Ubah ke true jika menggunakan mode produksi

            // Instantiate Midtrans notification object
            $notification = new Notification();

            // Retrieve order_id and transaction status from notification
            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;

            // Log the notification details for testing
            Log::info('Midtrans Notification Received: ', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus
            ]);

            // Cari transaksi berdasarkan order_id
            $transactions = Transaksi::where('order_id', $orderId)->get();


            if ($transactions->isEmpty()) {
                return response()->json(['error' => 'Transaction not found'], 404);
            }

            // Initialize the new status variable
            $newStatus = null;

            // Tentukan status baru berdasarkan status dari Midtrans
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $newStatus = 'challenge';
                } else {
                    $newStatus = 'success';
                }
            } elseif ($transactionStatus == 'settlement') {
                $newStatus = 'success';
            } elseif ($transactionStatus == 'pending') {
                $newStatus = 'pending';
            } elseif ($transactionStatus == 'deny') {
                $newStatus = 'denied';
            } elseif ($transactionStatus == 'expire') {
                $newStatus = 'expired';
            } elseif ($transactionStatus == 'cancel') {
                $newStatus = 'canceled';
            }

            // Perbarui status setiap transaksi yang terkait dengan order_id
            foreach ($transactions as $transaction) {

                $transaction->jenis_pembayaran = $notification->payment_type;
                $transaction->status = $newStatus;
                $transaction->save();

                // Jika status transaksi adalah 'success', kurangi stok produk
                if ($newStatus === 'success') {
                    // Cari produk berdasarkan kode_produk
                    $produk = \DB::table('produks')->where('kode_produk', $transaction->kode_produk)->first();

                    if ($produk) {

                        // Kurangi stok produk
                        $stokBaru = $produk->jumlah_produk - $transaction->qty;

                        // Pastikan stok tidak menjadi negatif
                        if ($stokBaru < 0) {
                            $stokBaru = 0;
                        }

                        // Update stok produk di database
                        \DB::table('produks')->where('kode_produk', $transaction->kode_produk)->update([
                            'jumlah_produk' => $stokBaru
                        ]);

                        $this->sendNotificationMessageWA($transaction);
                    } else {
                        Log::warning('Produk tidak ditemukan: ', ['kode_produk' => $transaction->kode_produk]);
                    }
                }
            }

            // Log perubahan status
            Log::info('Transaction Status Updated: ', [
                'order_id' => $orderId,
                'new_status' => $newStatus
            ]);

            return response()->json(['message' => 'Notification received and status updated, stock adjusted'], 200);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error handling Midtrans notification: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Failed to process notification'], 500);
        }
    }


    private function sendNotificationMessageWA($transaction)
    {


        // $messageTemplate = "test";
        $messageTemplate = " *Invoice Pembelian Anda*\n\n";

        $messageTemplate .= "Halo, {$transaction->name}!\n";
        $messageTemplate .= "Terima kasih telah berbelanja bersama kami. Berikut adalah detail pembelian Anda:\n\n";

        $messageTemplate .= " *Detail Pesanan:*\n";
        $messageTemplate .= "- Order ID: {$transaction->order_id}\n";
        $messageTemplate .= "- Tanggal: {$transaction->created_at->format('d M Y')}\n\n";

        $messageTemplate .= " *Produk yang Dibeli:*\n";
        $messageTemplate .= "- Nama Produk: {$transaction->nama_produk}\n";
        $messageTemplate .= "  Jumlah: {$transaction->qty}\n";
        $messageTemplate .= "------------------------------------\n";

        // $messageTemplate .= "\n *Pengiriman:*\n";
        $messageTemplate .= "- Nama Penerima: {$transaction->name}\n";
        $messageTemplate .= "- Alamat: {$transaction->alamat}\n";
        $messageTemplate .= "- Kota: {$transaction->city}\n";
        $messageTemplate .= "- Kode Pos: {$transaction->pos}\n";
        $messageTemplate .= "- Nomor HP: {$transaction->nohp}\n\n";

        $messageTemplate .= " *Telah melakukan pembayaran melalui:*\n";
        $messageTemplate .= "- Bank: {$transaction->jenis_pembayaran}\n";
        $messageTemplate .= "- Kurir: {$transaction->courier}\n";
        $messageTemplate .= "- Layanan Kurir: {$transaction->courier_service}\n";
        $messageTemplate .= "- Sebesar: *Rp" . number_format($transaction->total_pembayaran, 0, ',', '.') . "\n\n*";

        $messageTemplate .= " Jika ada pertanyaan, hubungi kami di 085859666343.\n\n";
        $messageTemplate .= "Terima kasih!\n";
        // Later change this message

        // Send message to buyer
        $this->whatsappService->sendMessage(
            $transaction->nohp,
            $messageTemplate
        );

        // Send message to Admin
        // $admin = "{{$ingpo->nowa}}";
        $admin = "085859666343";
        $this->whatsappService->sendMessage(
            //change this to admin number
            $admin,
            $messageTemplate
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}

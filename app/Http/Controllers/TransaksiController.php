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
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;


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

    public function getFilterRange(Request $request)
    {
        $startDate = $request->input('startDate')
            ? Carbon::parse($request->input('startDate'))->startOfDay()
            : (session('startDate')
                ? Carbon::parse(session('startDate'))->startOfDay()
                : Carbon::now()->subDays(30)->startOfDay());

        $endDate = $request->input('endDate')
            ? Carbon::parse($request->input('endDate'))->endOfDay()
            : (session('endDate')
                ? Carbon::parse(session('endDate'))->endOfDay()
                : Carbon::now()->endOfDay());

        $pilihKategori = $request->input('pilihKategori') ?? session('pilihKategori', 'semuaKategori');
        $pilihProduk = $request->input('pilihProduk') ?? session('pilihProduk', 'semuaProduk');

        // \Log::info('Session Data Before Save:', session()->all());

        session([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'pilihKategori' => $pilihKategori,
            'pilihProduk' => $pilihProduk,
        ]);

        session()->save(); // Explicitly save session

        // \Log::info('Session Data After Save:', session()->all());

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'pilihKategori' => $pilihKategori,
            'pilihProduk' => $pilihProduk,
        ];
    }


    public function view_tf(Request $request)
    {
        $user = Auth::user();
        $produk = Produk::all();
        $kategori = Kategori::all();
        $transaksi = Transaksi::all();
        $ingpo = Ingpo::all();

        $filterRange = $this->getFilterRange($request);
        $startDate = $filterRange['startDate'];
        $endDate = $filterRange['endDate'];
        $pilihKategori = $filterRange['pilihKategori'];
        $pilihProduk = $filterRange['pilihProduk'];

        $salesData = $this->getSalesData($request, $startDate, $endDate, $pilihKategori, $pilihProduk);
        $tableTransactionData = $this->getTableTransaksi($request, $startDate, $endDate, $pilihKategori, $pilihProduk);


        // Filter products based on selected category and product
        if ($pilihProduk !== 'semuaProduk') {
            // If a specific product is selected, filter by product name
            $produkByCategory = Produk::where('name', $pilihProduk)->get();
        } else {
            // If 'semuaProduk' is selected, filter products by the selected category
            if ($pilihKategori !== 'semuaKategori') {
                $produkByCategory = Produk::whereHas('kategori', function ($query) use ($pilihKategori) {
                    $query->where('name', $pilihKategori); // Filter by category name
                })->get();
            } else {
                // If 'semuaKategori' is selected, return all products
                $produkByCategory = Produk::all();
            }
        }

        // $startDate = session('startDate', Carbon::now()->subDays(7)->format('Y-m-d'));
        // $endDate = session('endDate', Carbon::now()->format('Y-m-d'));

        // Pass data to the view
        return view('admin.transaksi', [
            'title' => 'Penjualan',
            'salesData' => $salesData, // Data untuk grafik
            'tableTransactionData' => $tableTransactionData, // Data untuk tabel transaksi
            'groupedTransactions' => $tableTransactionData,
            'produk' => $produk,
            'user' => $user,
            'kategori' => $kategori,
            'transaksi' => $transaksi,
            'ingpo' => $ingpo,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'pilihKategori' => $pilihKategori,
            'pilihProduk' => $produkByCategory,
        ]);
    }

    // Data Transaksi (Chart)
    public function getSalesData(Request $request, $startDate, $endDate, $pilihKategori, $pilihProduk)
    {

        $tfQuery = Transaksi::query();
        $tfQuery->whereBetween('created_at', [$startDate, $endDate]);

        if ($pilihKategori && $pilihKategori != 'semuaKategori') {
            $selectedKategori = Kategori::where('name', $pilihKategori)->first();

            if ($selectedKategori) {
                $tfQuery->where('kategori_id', $selectedKategori->id);
            }
        }

        // Check if a specific product is selected and not 'semuaProduk'
        if ($pilihProduk && $pilihProduk != 'semuaProduk') {
            $tfQuery->where('nama_produk', $pilihProduk);
        }

        $sales = $tfQuery
            ->select(DB::raw('DATE(created_at) as sale_date'), 'nama_produk', DB::raw('SUM(qty) as total_sold'))
            ->groupBy(DB::raw('DATE(created_at)'), 'nama_produk')
            ->orderBy('sale_date', 'asc')
            ->get();

        $salesData = $sales->map(function ($item) {
            return [
                'product' => $item->nama_produk,
                'totalSold' => $item->total_sold,
                'saleDate' => Carbon::parse($item->sale_date)->format('d M Y'),
            ];
        });

        return $salesData;
    }

    // Data Tabel Transaksi
    public function getTableTransaksi(Request $request, $startDate, $endDate, $pilihKategori, $pilihProduk)
    {
        $tfQuery = Transaksi::query();
        $tfQuery->orderBy('created_at', 'desc');

        // Apply date range filter
        $tfQuery->whereBetween('created_at', [$startDate, $endDate]);

        // Check if a specific category is selected and not 'semuaKategori'
        if ($pilihKategori && $pilihKategori != 'semuaKategori') {
            $selectedKategori = Kategori::where('name', $pilihKategori)->first();

            if ($selectedKategori) {
                $tfQuery->where('kategori_id', $selectedKategori->id);
            }
        }

        // Check if a specific product is selected and not 'semuaProduk'
        if ($pilihProduk && $pilihProduk != 'semuaProduk') {
            $tfQuery->where('nama_produk', $pilihProduk);
        }

        // Pagination Tabel Produk
        $tfPagination = $tfQuery->paginate(10);

        $tfItems = $tfPagination->items();
        $tfCurrentPage = $tfPagination->currentPage();
        $tfTotalPages = $tfPagination->lastPage();
        $tfFirstPageUrl = $tfPagination->url(1);
        $tfLastPageUrl = $tfPagination->url($tfPagination->lastPage());
        $tfPreviousPageUrl = $tfPagination->previousPageUrl();
        $tfNextPageUrl = $tfPagination->nextPageUrl();

        // Group Transaksi by OrderID
        $groupedTransactions = collect($tfItems)->groupBy('order_id');

        return [
            'tfPagination' => $tfPagination,
            'tfItems' => $tfItems,
            'tfCurrentPage' => $tfCurrentPage,
            'tfTotalPages' => $tfTotalPages,
            'tfFirstPageUrl' => $tfFirstPageUrl,
            'tfLastPageUrl' => $tfLastPageUrl,
            'tfPreviousPageUrl' => $tfPreviousPageUrl,
            'tfNextPageUrl' => $tfNextPageUrl,
            'groupedTransactions' => $groupedTransactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'pilihKategori' => $pilihKategori,
            'pilihProduk' => $pilihProduk,
        ];
    }



    public function showInvoice($orderId)
    {
        // Ambil transaksi berdasarkan order_id
        $invoice = Transaksi::where('order_id', $orderId)->first();
        $ingpo = Ingpo::all();

        // Jika tidak ada invoice yang ditemukan, tampilkan halaman 404
        if (!$invoice) {
            return abort(404, 'Invoice tidak ditemukan');
        }
        $items = Transaksi::where('order_id', $orderId)->get();
        // dd($items);
        // Format tanggal invoice
        $invoice->formatted_date = Carbon::parse($invoice->created_at)->format('d M Y');

        // Kirimkan data ke view
        return view('admin.invoice-page', compact('invoice', 'items', 'ingpo'));
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
                'products.*.kode_produk' => 'required|string',
                'name' => 'required|string',
                'alamat' => 'required|string',
                'city' => 'required|string',
                'pos' => 'required|string',
                'nohp' => 'required|string',
                'cost' => 'required|numeric',
                // 'kode_produk' => 'required|exists:produks,kode_produk', // Validasi berdasarkan kode_produk
                // 'kategori_id' => 'required|exists:kategoris,id', // Memastikan kategori ada
                'courier' => 'required|string',
                'courier_service' => 'required|string',
                'province' => 'required|string',
            ]);

            Log::info('Transaction Status Updated: ', [
                "PRODUCT" => $validated,
            ]);



            // Iterasi melalui setiap produk dan simpan transaksi per produk
            foreach ($validated['products'] as $product) {
                $transaksi = new Transaksi([
                    'order_id' => $gen_id_order,
                    'kode_produk' => $product['kode_produk'],
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
                    'province' => $validated['province'],
                    'courier' => $validated['courier'],
                    'courier_service' => $validated['courier_service'],
                    'cost' => $validated['cost'],
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

    // public function notificationHandler(Request $request)
    // {
    //     try {
    //         // Konfigurasi Midtrans
    //         Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-9zcBME8uz3JAPNkLONOYiCEa');
    //         Config::$isProduction = false; // Ubah ke true jika menggunakan mode produksi

    //         // Instantiate Midtrans notification object
    //         $notification = new Notification();

    //         // Retrieve order_id and transaction status from notification
    //         $orderId = $notification->order_id;
    //         $transactionStatus = $notification->transaction_status;
    //         $fraudStatus = $notification->fraud_status;



    //         // Log the notification details for testing
    //         Log::info('Midtrans Notification Received: ', [
    //             'order_id' => $orderId,
    //             'transaction_status' => $transactionStatus,
    //             'fraud_status' => $fraudStatus,
    //         ]);

    //         // Cari transaksi berdasarkan order_id
    //         $transactions = Transaksi::where('order_id', $orderId)->get();


    //         if ($transactions->isEmpty()) {
    //             return response()->json(['error' => 'Transaction not found'], 404);
    //         }

    //         // Initialize the new status variable
    //         $newStatus = null;

    //         // Tentukan status baru berdasarkan status dari Midtrans
    //         if ($transactionStatus == 'capture') {
    //             if ($fraudStatus == 'challenge') {
    //                 $newStatus = 'challenge';
    //             } else {
    //                 $newStatus = 'success';
    //             }
    //         } elseif ($transactionStatus == 'settlement') {
    //             $newStatus = 'success';
    //         } elseif ($transactionStatus == 'pending') {
    //             $newStatus = 'pending';
    //         } elseif ($transactionStatus == 'deny') {
    //             $newStatus = 'denied';
    //         } elseif ($transactionStatus == 'expire') {
    //             $newStatus = 'expired';
    //         } elseif ($transactionStatus == 'cancel') {
    //             $newStatus = 'canceled';
    //         }

    //         // Declare array to store all product details
    //         $productDetails = [];
    //         $transactionData = null;
    //         $storeName = $notification->store ?? null;
    //         // Log::info('Store Name: ' . $storeName);
    //         $bank = isset($notification->va_numbers[0]->bank) ? $notification->va_numbers[0]->bank : null;
    //         // Perbarui status setiap transaksi yang terkait dengan order_id
    //         foreach ($transactions as $transaction) {
    //             $transaction->jenis_pembayaran = $notification->payment_type;
    //             $transaction->status = $newStatus;
    //             $transaction->bank = $bank;
    //             $transaction->store_name = $storeName;
    //             $transaction->save();

    //             // Jika status transaksi adalah 'success', kurangi stok produk
    //             if ($newStatus === 'success' && $transaction->isChecked) {
    //                 // Cari produk berdasarkan kode_produk
    //                 $produk = \DB::table('produks')
    //                     ->where('kode_produk', $transaction->kode_produk)
    //                     ->first();
    //                 if ($produk) {

    //                     // Kurangi stok produk
    //                     $stokBaru = $produk->jumlah_produk - $transaction->qty;


    //                     // Pastikan stok tidak menjadi negatif
    //                     if ($stokBaru < 0) {
    //                         $stokBaru = 0;
    //                     }

    //                     // Update stok produk di database
    //                     \DB::table('produks')->where('kode_produk', $transaction->kode_produk)->update([
    //                         'jumlah_produk' => $stokBaru
    //                     ]);
    //                     $transactionData = $transaction;
    //                     $productDetails[] = [
    //                         "nama_produk" => $transaction->nama_produk,
    //                         "qty" => $transaction->qty,
    //                         "harga" => $transaction->harga
    //                     ];
    //                 } else {
    //                     Log::warning('Produk tidak ditemukan: ', ['kode_produk' => $transaction->kode_produk]);
    //                 }
    //             }
    //         }
    //         if ($transaction->isChecked) {
    //             $this->sendNotificationMessageWA($transactionData, $productDetails);
    //         }
    //         if ($newStatus === 'success' && $fraudStatus === 'accept') {
    //             foreach ($transactions as $transaction) {
    //                 $transaction->isChecked = true;
    //                 $transaction->save();
    //             }
    //         }

    //         // Log perubahan status
    //         Log::info('Transaction Status Updated: ', [
    //             'productDetails' => $productDetails,
    //         ]);
    //         // Log perubahan status
    //         Log::info('Transaction Status Updated: ', [
    //             'order_id' => $orderId,
    //             'new_status' => $newStatus
    //         ]);

    //         return response()->json(['message' => 'Notification received and status updated, stock adjusted'], 200);
    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error('Error handling Midtrans notification: ' . $e->getMessage());

    //         // Return error response
    //         return response()->json(['error' => 'Failed to process notification'], 500);
    //     }
    // }

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

            // Log the notification details for testing
            Log::info('Midtrans Notification Received: ', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
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
                $newStatus = 'success';  // Jika transaksi capture, anggap berhasil
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

            // Declare array to store all product details
            $productDetails = [];
            $transactionData = null;
            $storeName = $notification->store ?? null;
            $bank = isset($notification->va_numbers[0]->bank) ? $notification->va_numbers[0]->bank : null;

            // Perbarui status setiap transaksi yang terkait dengan order_id
            foreach ($transactions as $transaction) {
                $transaction->jenis_pembayaran = $notification->payment_type;
                $transaction->status = $newStatus;
                $transaction->bank = $bank;
                $transaction->store_name = $storeName;
                $transaction->save();

                // Jika status transaksi adalah 'success' dan belum terproses (isChecked == false), kurangi stok produk
                if ($newStatus === 'success' && !$transaction->isChecked) {
                    // Cari produk berdasarkan kode_produk
                    $produk = \DB::table('produks')
                        ->where('kode_produk', $transaction->kode_produk)
                        ->first();

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
                        $transactionData = $transaction;
                        $productDetails[] = [
                            "nama_produk" => $transaction->nama_produk,
                            "qty" => $transaction->qty,
                            "harga" => $transaction->harga
                        ];

                        // Mark transaction as checked to avoid reducing stock twice
                        $transaction->isChecked = true;
                        $transaction->save();
                    } else {
                        Log::warning('Produk tidak ditemukan: ', ['kode_produk' => $transaction->kode_produk]);
                    }
                }
            }

            // Send messages only if the status is 'success'
            if ($newStatus === 'success') {
                // Log perubahan status
                Log::info('Transaction Status Updated: ', [
                    'productDetails' => $productDetails,
                ]);
                $this->sendNotificationMessageWA($transactionData, $productDetails);
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



    private function sendNotificationMessageWA($transaction, $produks)
    {


        // $messageTemplate = "test";
        $messageTemplate = " 📋 *Invoice Pembelian Anda*\n\n";

        $messageTemplate .= "Halo, *{$transaction->name}!*\n";
        $messageTemplate .= "Terima kasih telah berbelanja bersama kami. Berikut adalah detail pembelian Anda:\n\n";

        $messageTemplate .= " 📦 *Detail Pesanan:*\n";
        $messageTemplate .= "- Order ID: {$transaction->order_id}\n";
        $messageTemplate .= "- Tanggal: {$transaction->created_at->format('d M Y')}\n\n";

        $messageTemplate .= " 🛒 *Produk yang Dibeli:*\n";

        foreach ($produks as $product) {
            $messageTemplate .= "- Nama Produk: *{$product['nama_produk']}*\n";
            $messageTemplate .= "- Harga Produk: Rp. " . number_format($product['harga'], 0, ',', '.') . "\n";
            $messageTemplate .= "- Jumlah: {$product['qty']}\n";
            $messageTemplate .= "------------------------------------\n";
        }

        $messageTemplate .= " \n🚚 *Pengiriman:*\n";
        $messageTemplate .= "- Nama Penerima: {$transaction->name}\n";
        $messageTemplate .= "- Nomor HP: {$transaction->nohp}\n";
        $messageTemplate .= "- Alamat: {$transaction->alamat}\n";
        $messageTemplate .= "- Kota: {$transaction->city}\n";
        $messageTemplate .= "- Kode Pos: {$transaction->pos}\n";
        $messageTemplate .= "- Provinsi: {$transaction->province}\n";

        $messageTemplate .= " \n📌 *Telah melakukan pembayaran melalui:*\n";
        $messageTemplate .= "- Metode Pembayaran: " . ($transaction->bank ?? $transaction->store_name) . "\n";
        $messageTemplate .= "- Kurir: {$transaction->courier}\n";
        $messageTemplate .= "- Layanan Kurir: {$transaction->courier_service}\n";
        $messageTemplate .= "- Ongkos Kirim: Rp " . number_format($transaction->cost, 0, ',', '.') . "\n\n";
        $messageTemplate .= "- Total Pembayaran: *Rp" . number_format($transaction->total_pembayaran, 0, ',', '.') . "*\n\n";

        $messageTemplate .= " Jika ada pertanyaan, hubungi kami di 085859666343.\n\n";
        $messageTemplate .= "Terima kasih!\n";


        Log::info('Update WA: ', [
            'WA' => $transaction->nohp,
        ]);
        // Send message to buyer
        $result = $this->whatsappService->sendMessage(
            $transaction->nohp,
            $messageTemplate
        );
        Log::info('Update WA: ', [
            'response wa' => $result,
        ]);
        // Send message to Admin
        // $admin = "{{$ingpo->nowa}}";
        $admin = "087716068691";
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

<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiMidtrans;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }


    public function createTransaction(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'total_pembayaran' => 'required|numeric',
                'kode_produk' => 'required|string',
                'nama_produk' => 'required|string',
                'qty' => 'required|numeric',
                'harga' => 'required|numeric',
                'name' => 'required|string',
                'alamat' => 'required|string',
                'city' => 'required|string',
                'pos' => 'required|string',
                'nohp' => 'required|string',
                'kategori_id' => 'required|string',
            ]);

            // For now, comment the database part
            // $transaction = TransaksiMidtrans::create([
            //     'order_id' => 'ORDER-' . time(),
            //     'total_pembayaran' => $validated['total_pembayaran'],
            //     'kode_produk' => $validated['kode_produk'],
            //     'nama_produk' => $validated['nama_produk'],
            //     'qty' => $validated['qty'],
            //     'harga' => $validated['harga'],
            //     'name' => $validated['name'],
            //     'alamat' => $validated['alamat'],
            //     'city' => $validated['city'],
            //     'pos' => $validated['pos'],
            //     'nohp' => $validated['nohp'],
            //     'kategori_id' => $validated['kategori_id'],
            //     'status' => 'pending' // Initial status is pending
            // ]);
            // Set up Midtrans configuration
            Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-9zcBME8uz3JAPNkLONOYiCEa');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Prepare Midtrans transaction details
            $params = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . rand(),
                    'gross_amount' => $validated['total_pembayaran'],
                ],
                'item_details' => [
                    [
                        'id' => $validated['kode_produk'],
                        'name' => $validated['nama_produk'],
                        'quantity' => $validated['qty'],
                        'price' => $validated['harga'],
                        'category' => $validated['kategori_id'],
                    ]
                ],
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
            return response()->json(['error' => 'Something went wrong.'], 500);
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
    //         // Instantiate Midtrans notification object
    //         $notification = new Notification();

    //         // Retrieve order_id and transaction status from notification
    //         $orderId = $notification->order_id;
    //         $transactionStatus = $notification->transaction_status;
    //         $fraudStatus = $notification->fraud_status;

    //         // Log the notification for debugging purposes
    //         Log::info("Midtrans Notification: Order ID: $orderId, Status: $transactionStatus");

    //         // Find the corresponding transaction in your database
    //         // $transaction = Transaction::where('order_id', $orderId)->firstOrFail();

    //         // Handle transaction statuses
    //         if ($transactionStatus == 'capture') {
    //             // For credit card transactions, check whether the transaction is challenged by fraud detection
    //             if ($fraudStatus == 'challenge') {
    //                 $transaction->status = 'challenge';
    //             } else {
    //                 $transaction->status = 'success';
    //             }
    //         } elseif ($transactionStatus == 'settlement') {
    //             // Update the transaction status to success
    //             $transaction->status = 'success';
    //         } elseif ($transactionStatus == 'pending') {
    //             // Update the transaction status to pending
    //             $transaction->status = 'pending';
    //         } elseif ($transactionStatus == 'deny') {
    //             // Update the transaction status to denied
    //             $transaction->status = 'denied';
    //         } elseif ($transactionStatus == 'expire') {
    //             // Update the transaction status to expired
    //             $transaction->status = 'expired';
    //         } elseif ($transactionStatus == 'cancel') {
    //             // Update the transaction status to canceled
    //             $transaction->status = 'canceled';
    //         }

    //         // Save the updated status to the database
    //         $transaction->save();

    //         return response()->json(['message' => 'Notification successfully processed'], 200);
    //     } catch (\Exception $e) {
    //         Log::error('Error handling Midtrans notification: ' . $e->getMessage());
    //         return response()->json(['error' => 'Failed to process notification'], 500);
    //     }
    // }

    public function notificationHandler(Request $request)
    {
        try {
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

            // For testing purposes, find the corresponding transaction in the database
            // $transaction = Transaction::where('order_id', $orderId)->firstOrFail();

            // Initialize the new status variable
            $newStatus = null;

            // Handle transaction statuses without saving to the database
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

            // Log the new status for testing purposes
            Log::info('Transaction Status Update: ', [
                'order_id' => $orderId,
                // 'old_status' => $transaction->status,
                'new_status' => $newStatus
            ]);

            // Optionally, use dd() for testing if you want to see the values directly in the response
            // dd('Old Status: ' . $transaction->status, 'New Status: ' . $newStatus);

            // Do not save the transaction to the database during testing
            // $transaction->status = $newStatus;
            // $transaction->save();

            return response()->json(['message' => 'Notification received and status logged'], 200);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error handling Midtrans notification: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Failed to process notification'], 500);
        }
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
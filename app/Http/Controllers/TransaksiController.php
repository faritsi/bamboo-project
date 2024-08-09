<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Services\MidtransService;

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

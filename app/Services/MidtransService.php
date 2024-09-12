<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    public function getTransactionStatus($orderId)
    {
        try {
            $status = Transaction::status($orderId);
            return $status;
        } catch (\Exception $e) {
            // Handle exception
            return null;
        }
    }

    public function getAllStoredTransactions()
    {
        // Fetch transactions from your local database
        return \DB::table('transaksis')->get();
    }
}

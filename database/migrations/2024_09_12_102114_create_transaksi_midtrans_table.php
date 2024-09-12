<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_midtrans', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the transaction
            $table->string('order_id')->unique(); // Unique order ID for Midtrans
            $table->enum('status', ['pending', 'paid', 'failed', 'canceled']); // Enum for transaction status
            $table->integer('price_barang'); // Price per item
            $table->integer('jumlah_barang'); // Number of items purchased
            $table->integer('total_harga_barang'); // Total price of items (price_barang * jumlah_barang)
            $table->integer('grand_total'); // Total amount to be paid (including shipping, etc.)
            $table->enum('jenis_pembayaran', ['credit_card', 'bank_transfer', 'gopay', 'other']); // Payment method
            $table->string('kurir'); // Courier service
            $table->string('nama_layanan'); // Courier service type
            $table->integer('harga_pengiriman');
            $table->string('nama_pembeli'); // Buyer's name
            $table->text('alamat'); // Buyer's address
            $table->string('no_telepon'); // Buyer's phone number
            $table->string('kota'); // City
            $table->string('kode_pos'); // Postal code
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_midtrans');
    }
};

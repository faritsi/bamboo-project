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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('kode_produk');
            $table->foreign('kode_produk')->references('kode_produk')->on('produks')->onDelete('cascade');
            $table->foreignId('kategori_id');
            $table->integer('total_pembayaran');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->integer('harga');
            $table->string('name');
            $table->string('nohp');
            $table->string('alamat');
            $table->string('pos');
            $table->string('city');
            $table->string('status');
            // $table->timestamp('transaction_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

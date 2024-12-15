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
            $table->string('province');


            // Edit from migrte
            $table->string('courier');
            $table->string('courier_service');
            $table->integer('cost');
            $table->string('jenis_pembayaran')->nullable();
            $table->string('store_name')->nullable();
            $table->string('bank')->nullable();
            $table->boolean('isChecked')->default(false);
            // 

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

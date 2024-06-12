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
            $table->string('pmb');
            $table->string('nama');
            $table->string('produk');
            $table->string('alamat');
            $table->string('metode');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('tot_harga');
            $table->string('status');
            $table->dateTime('tgl_pmb', $precision = 0);
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

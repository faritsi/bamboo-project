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
        Schema::create('produks', function (Blueprint $table) {
            $table->string('pid');
            $table->string('kode_produk')->unique();
            $table->String('nama_produk');
            $table->String('jenis_produk');
            $table->Integer('jumlah_produk');
            $table->String('image')->nullable();
            $table->String('deskripsi')->nullable();
            $table->String('tokped');
            $table->String('shopee');
            $table->Integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

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
            $table->foreignId('kategori_id');
            // From edit migrate
            $table->string('kode_produk')->unique();
            // 
            $table->String('nama_produk')->unique();
            // $table->String('jenis_produk');
            $table->Integer('jumlah_produk');
            $table->String('image')->nullable();
            $table->String('image1')->nullable();
            $table->String('image2')->nullable();
            $table->String('image3')->nullable();
            $table->String('image4')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('tokped');
            $table->text('shopee');
            $table->Integer('harga');
            $table->Integer('berat');
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

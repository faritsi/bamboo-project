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
            $table->String('judul')->nullable();
            $table->String('slug')->nullable();
            $table->String('image')->nullable();
            $table->String('deskripsi')->nullable();
            $table->String('tokped')->nullable();
            $table->String('shopee')->nullable();
            $table->Integer('harga')->nullable();
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
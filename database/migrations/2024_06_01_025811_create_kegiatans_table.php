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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->String('image1')->nullable();
            $table->String('image2')->nullable();
            $table->String('image3')->nullable();
            $table->String('image4')->nullable();
            $table->String('image5')->nullable();
            $table->String('image6')->nullable();
            $table->String('image7')->nullable();
            $table->String('image8')->nullable();
            $table->String('image9')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};

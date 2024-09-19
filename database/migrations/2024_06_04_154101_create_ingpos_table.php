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
        Schema::create('ingpos', function (Blueprint $table) {
            $table->id();
            $table->String('image_header')->nullable();
            $table->String('desc_header')->nullable();
            $table->String('slogan')->nullable();
            $table->String('desc_slogan')->nullable();
            $table->String('image_about')->nullable();
            $table->String('judul_about')->nullable();
            $table->String('desc_about')->nullable();
            $table->String('image_visi')->nullable();
            $table->String('desc_visi')->nullable();
            $table->String('image_misi')->nullable();
            $table->String('desc_misi')->nullable();
            $table->String('judul_service')->nullable();
            $table->String('desc_service')->nullable();
            $table->String('logo_service1')->nullable();
            $table->String('judul_service1')->nullable();
            $table->String('desc_service1')->nullable();
            $table->String('logo_service2')->nullable();
            $table->String('judul_service2')->nullable();
            $table->String('desc_service2')->nullable();
            $table->String('logo_service3')->nullable();
            $table->String('judul_service3')->nullable();
            $table->String('desc_service3')->nullable();
            $table->String('logo_service4')->nullable();
            $table->String('judul_service4')->nullable();
            $table->String('desc_service4')->nullable();
            $table->String('judul_produk')->nullable();
            $table->String('desc_produk')->nullable();
            $table->String('logo_footer')->nullable();
            $table->String('judul_footer')->nullable();
            $table->String('desc_footer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingpos');
    }
};

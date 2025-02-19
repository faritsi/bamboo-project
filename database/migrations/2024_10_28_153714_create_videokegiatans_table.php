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
        Schema::create('videokegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('video_path')->nullable();
            // From eddit migrate
            $table->string('video_link')->nullable();
            // 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videokegiatans');
    }
};

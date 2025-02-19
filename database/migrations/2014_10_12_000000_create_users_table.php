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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id');
            $table->String('name');
            $table->String('username')->unique();
            $table->String('password');
            $table->String('image')->nullabel();
            $table->timestamps();
        });

        // Schema::create('users', function (Blueprint $table) {
        //     $table->id(); // Primary Key
        //     $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Foreign Key to roles table
        //     $table->string('name', 255); // User's full name
        //     $table->string('username', 255)->unique(); // Unique username
        //     $table->string('password'); // Password
        //     $table->string('image')->nullable(); // Nullable profile image
        //     $table->timestamps(); // Created at and updated at timestamps
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            // Add foreign key constraint to roles table
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->change();

            // Modify name and username fields
            $table->string('name', 255)->change(); // Ensure max length is 255
            $table->string('username', 255)->unique()->change(); // Unique and max length 255

            // Make image field nullable
            $table->string('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove foreign key constraint
            $table->dropForeign(['role_id']);
            $table->integer('role_id')->change(); // Revert to integer if necessary

            // Revert name and username fields
            $table->string('name')->change();
            $table->string('username')->unique(false)->change();

            // Revert image field
            $table->string('image')->nullable(false)->change();
        });
    }
};

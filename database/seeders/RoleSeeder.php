<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => 'Superadmin'],
            ['name' => 'Admin'],
        ];

        foreach ($data as $value) {
            Role::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // $roles = [
        //     ['name' => 'Superadmin', 'slug' => 'superadmin', 'description' => 'Full access to all resources.'],
        //     ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Access to manage system resources.'],
        // ];

        // // Insert data into the roles table
        // foreach ($roles as $role) {
        //     Role::create([
        //         'name' => $role['name'],
        //         'slug' => $role['slug'],
        //         'description' => $role['description'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'role_id' => 1,
                'name' => 'Jeki',
                'username' => 'superadmin',
                'password' => bcrypt('superadmin'),
                'image' => 'dddd',
            ],
            [
                'role_id' => 2,
                'name' => 'Jeki 2',
                'username' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'image' => 'dddd',
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }

        // $users = [
        //     [
        //         'role_id' => Role::where('slug', 'superadmin')->first()->id, // Fetch role_id dynamically
        //         'name' => 'Jeki',
        //         'username' => 'superadmin',
        //         'password' => Hash::make('superadmin'), // Use Hash facade for security
        //         'image' => 'superadmin-image.jpg', // Replace with actual image if necessary
        //     ],
        //     [
        //         'role_id' => Role::where('slug', 'admin')->first()->id, // Fetch role_id dynamically
        //         'name' => 'Jeki 2',
        //         'username' => 'admin@gmail.com',
        //         'password' => Hash::make('admin'),
        //         'image' => 'admin-image.jpg', // Replace with actual image if necessary
        //     ],
        // ];

        // // Insert user data
        // foreach ($users as $user) {
        //     User::create($user);
        // }
    }
}

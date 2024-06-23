<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            ],
            [
                'role_id' => 2,
                'name' => 'Jeki 2',
                'username' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
            ]
            ];
            foreach ($user as $key => $value) {
                User::create($value);
            }
    }
}
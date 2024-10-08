<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk = [
            [
                'judul' => 'Narkoboy',
                'slug' => 'narkoboy',
                'image' => 'narko',
                'deskripsi' => 'narkoboy enak mantap',
                'tokped' => 'https://tokopedia.com',
                'shopee' => 'https://shopee.com',
            ],
            [
                'judul' => 'Lepboy',
                'slug' => 'Lepboy',
                'image' => 'leboy',
                'deskripsi' => 'Lepboy enak mantap',
                'tokped' => 'https://tokopedia.com',
                'shopee' => 'https://shopee.com',
            ]
            ];
            foreach ($produk as $key => $value) {
                Produk::create($value);
            }
    }
}

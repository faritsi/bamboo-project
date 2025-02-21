<?php

namespace Database\Seeders;

use App\Models\Ingpo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuDinamis extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingpo = [
            [
                'favicon' => '/img/bambu/bambu_11.jpeg',
                'title' => 'bintang',
                'image_header' => '/img/bambu/bambu_11.jpeg',
                'desc_header' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus enim ullam repellat eligendi sint. Iusto iste ullam dolor odit qui.',
                'slogan' => 'Memanfaatkan Keanekaragaman Alam: Inovasi Bambu untuk Kehidupan Berkelanjutan',
                'desc_slogan' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In voluptates reprehenderit libero rerum corrupti a ducimus consequatur molestiae debitis est?',
                'image_about' => 'img/bambu/bambu_8.jpeg',
                'judul_about' => 'About Us',
                'desc_about' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum vitae culpa quis, maxime amet doloremque fugit eaque odit placeat laudantium cupiditate',
                'image_visi_misi' => '/img/logo/visi.png',
                'desc_visi' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum vitae culpa quis, maxime amet doloremque fugit eaque odit placeat laudantium cupiditate',
                // 'image_misi' => '/img/logo/misi.png',
                'desc_misi' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum vitae culpa quis, maxime amet doloremque fugit eaque odit placeat laudantium cupiditate',
                'judul_service' => 'Our Service',
                'desc_service' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum vitae culpa quis, maxime amet doloremque fugit eaque odit placeat laudantium cupiditate',
                'desc_produk' => 'Temukan produk bambu berkualitas tinggi yang ramah lingkungan dan tahan lama. Setiap produk dibuat dengan penuh perhatian dan keahlian.',
                // 'logo_footer' => 'img/logo.png',
                'judul_footer' => 'PT. Bintang Mitra Kencana',
                'desc_footer' => 'Kami berkomitmen untuk menyediakan produk berkualitas tinggi dengan inovasi berkelanjutan untuk masa depan yang lebih baik.',
                'nowa' => '08123456789',
                'instagram' => 'instagram.com',
            ],
        ];
        foreach ($ingpo as $key => $value) {
            Ingpo::create($value);
        }
    }
}

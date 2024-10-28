<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class coba extends Controller
{
    // Fungsi untuk mendapatkan daftar provinsi
    public function getProvinces()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ]
        ]);

        $provinces = json_decode($response->getBody(), true);
        return response()->json($provinces['rajaongkir']['results']);
    }

    // Fungsi untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
    public function getCities($province_id)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city?province=' . $province_id, [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ]
        ]);

        $cities = json_decode($response->getBody(), true);
        return response()->json($cities['rajaongkir']['results']);
    }

    // Fungsi untuk menghitung biaya ongkir
    public function getCost(Request $request)
{
    $client = new Client();
    $response = $client->post('https://api.rajaongkir.com/starter/cost', [
        'headers' => [
            'key' => env('RAJAONGKIR_API_KEY'),
        ],
        'form_params' => [
            'origin' => $request->origin, // ID kota asal
            'destination' => $request->destination, // ID kota tujuan
            'weight' => $request->weight, // Berat barang (gram)
            'courier' => $request->courier // JNE, POS, TIKI, dll
        ]
    ]);

    $cost = json_decode($response->getBody(), true);
    return response()->json($cost['rajaongkir']['results']);
}
  
}

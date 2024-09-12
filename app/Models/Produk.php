<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $fillable = [ 
        'pid',
        'kode_produk',
        'nama_produk',
        'jenis_produk',
        'jumlah_produk',
        'image',
        'harga',
        'deskripsi',
        'tokped',
        'shopee',
    ]; 
    // protected $primaryKey = ['pid'];
}

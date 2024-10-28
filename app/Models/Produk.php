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
        'kategori_id',
        'jumlah_produk',
        'image',
        'image1',
        'image2',
        'image3',
        'image4',
        'berat',
        'harga',
        'deskripsi',
        'tokped',
        'shopee',
    ]; 
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    // protected $primaryKey = ['pid'];
}

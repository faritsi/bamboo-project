<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function produk()
    {
        return $this->hasOne(Produk::class);
        // return $this->hasMany(Produk::class)
    }
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
        // return $this->hasMany(Transaksi::class)
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}

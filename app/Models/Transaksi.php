<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
// protected $fillable = [
    //     'order_id',
    //     'kategori_id',
    //     // 'kode_produk'
    // ];
    protected $guarded = ['id'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
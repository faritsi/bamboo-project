<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'order_id',
    //     'status',
    //     'gross_amount',
    //     'transaction_time',
    //     'produk_id',
    //     'nama_produk',
    //     'qty',
    //     'price',
    //     'total',
    // ];
    protected $guarded = ['id'];
}

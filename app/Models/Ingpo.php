<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingpo extends Model
{
    use HasFactory;
    protected $fillable = [
        'iid',
        'email',
        'nowa',
    ];
}

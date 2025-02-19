<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntegrasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ingpo = Ingpo::all();

        return view(
            'admin.integrasi',
            [
                'title' => 'Integrasi',
            ],
            compact('user', 'ingpo')
        );
    }
}

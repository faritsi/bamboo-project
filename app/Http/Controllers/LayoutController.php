<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Produk;
use App\Models\Pimpinan;
use App\Models\Ingpo;

class LayoutController extends Controller
{
    public function halu()
    {
        return view('halaman.new-dashboard')->with([
            'title' => 'Halaman Utama',
            'produk' => produk::orderBy('created_at')->take(3)->get(),
            'pimpinan' => Pimpinan::take(4)->get(),
            'ingpo' => Ingpo::all(),
        ]);
    }
    public function index()
    {
        $user1 = User::count();
        // return view('halaman.dashboard-admin')->with([
        //     'title' => 'Dashboard'
        // ]);
        return view('admin.beranda')->with([
            'user' => Auth::user(),
            'role' => role::all(),
            'title' => 'Dashboard'
        ], compact('user1'));
    }
}

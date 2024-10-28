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
use App\Models\Kegiatan;
use App\Models\Service;
use App\Models\videokegiatan;

class LayoutController extends Controller
{
    public function halu()
    {
        return view('halaman.dashboard')->with([
            'title' => 'Halaman Utama',
            'produk' => produk::orderBy('created_at')->take(5)->get(),
            'pimpinan' => Pimpinan::take(4)->get(),
            'ingpo' => Ingpo::all(),
            'service' => Service::all(),
            'video' => videokegiatan::all(),
            'kegiatan' => Kegiatan::orderBy('created_at')->take(5)->get(),
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
            'ingpo' => Ingpo::all(),
            'role' => role::all(),
            'title' => 'Dashboard'
        ], compact('user1'));
    }
}

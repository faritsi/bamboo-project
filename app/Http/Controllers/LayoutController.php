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
use App\Models\Transaksi;
use App\Models\videokegiatan;
use App\Models\visitor;

class LayoutController extends Controller
{
    public function halu()
    {
        return view('halaman.dashboard')->with([
            'title' => 'Halaman Utama',
            'produk' => produk::orderBy('created_at')->take(20)->get(),
            // 'pimpinan' => Pimpinan::take(4)->get(),
            'pimpinan' => Pimpinan::all(),
            'ingpo' => Ingpo::all(),
            'service' => Service::all(),
            'video' => videokegiatan::all(),
            // 'kegiatan' => Kegiatan::orderBy('created_at')->take(10)->get(),
            'kegiatan' => Kegiatan::all(),
        ]);
    }
    public function index()
    {
        // Hitung jumlah data untuk masing-masing entitas
        $totalAdmins = User::where('role_id', '2')->count();
        $totalPimpinan = Pimpinan::count();
        $totalProduk = Produk::count();
        $totalPenjualan = Transaksi::count();
        $totalPengunjung = Visitor::count();
        $totalPendapatan = Transaksi::select(DB::raw('sum(qty * harga) as total_pembayaran'))
            ->where('status', 'success')
            ->groupBy('order_id')
            ->get();


        // Hitung total pendapatan keseluruhan
        // \Log::info('Hasil Query Total Pendapatan: ', $totalPendapatan->toArray());

        $totalPendapatanValue = $totalPendapatan->sum('total_pembayaran') ?? 0; // Menjumlahkan semua total_pembayaran

        $user1 = User::count(); // Total semua pengguna

        // Kirim data ke view
        return view('admin.beranda', [
            'user' => Auth::user(),
            'ingpo' => Ingpo::all(),
            'role' => Role::all(),
            'title' => 'Dashboard',
            'totalAdmins' => $totalAdmins,
            'totalPimpinan' => $totalPimpinan,
            'totalProduk' => $totalProduk,
            'totalPenjualan' => $totalPenjualan,
            'totalPengunjung' => $totalPengunjung,
            'totalPendapatanValue' => $totalPendapatanValue,
            'user1' => $user1, // Total pengguna
        ]);
    }
}

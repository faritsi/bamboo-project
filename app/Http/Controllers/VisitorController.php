<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use App\Models\visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{

    public function getVisitorCount()
    {
        $today = Visitor::whereDate('created_at', Carbon::today())->count();
        $thisWeek = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $thisMonth = Visitor::whereMonth('created_at', Carbon::now()->month)->count();
        $totalVisits = Visitor::count();

        return [
            'today' => $today,
            'thisWeek' => $thisWeek,
            'thisMonth' => $thisMonth,
            'totalVisits' => $totalVisits,
        ];
    }

    public function showStats()
    {
        $user = Auth::user();
        $produk = Produk::all();
        $kategori = Kategori::all();
        $tf = Transaksi::all();
        // Get the visitor counts for the chart
        $dailyVisitors = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(7) // Last 7 days for example
            ->get();

        // Total counts (already discussed earlier)
        $today = Visitor::whereDate('created_at', Carbon::today())->count();
        $thisWeek = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $thisMonth = Visitor::whereMonth('created_at', Carbon::now()->month)->count();
        $totalVisits = Visitor::count();

        return view('admin.pengunjung', ['title' => 'Pengunjung'], compact('dailyVisitors', 'today', 'thisWeek', 'thisMonth', 'totalVisits', 'produk', 'user', 'kategori', 'tf'));
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(visitor $visitor)
    {
        //
    }
}

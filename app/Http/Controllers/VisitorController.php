<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
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

    public function getVisitorStats(Request $request)
    {
        // Default date range
        $startDate = $request->input('startDate')
            ? Carbon::parse($request->input('startDate'))->startOfDay()
            : (session('startDate')
                ? Carbon::parse(session('startDate'))->startOfDay()
                : Carbon::now()->subDays(7)->startOfDay());

        $endDate = $request->input('endDate')
            ? Carbon::parse($request->input('endDate'))->endOfDay()
            : (session('endDate')
                ? Carbon::parse(session('endDate'))->endOfDay()
                : Carbon::now()->endOfDay());

        // Save the dates to the session
        session(['startDate' => $startDate, 'endDate' => $endDate]);

        // Query visitor data based on date range
        $filteredVisitors = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($visitor) {
                return [
                    'date' => Carbon::parse($visitor->date)->format('d M Y'),
                    'count' => $visitor->count,
                ];
            });


        return [
            'dailyVisitors' => $filteredVisitors,
            'startDate' => $startDate->format('Y-m-d'), // Pass as Y-m-d for frontend compatibility
            'endDate' => $endDate->format('Y-m-d'),
        ];
    }

    public function showStats(Request $request)
    {
        $user = Auth::user();
        $produk = Produk::all();
        $kategori = Kategori::all();
        $tf = Transaksi::all();
        $ingpo = Ingpo::all();

        // Query data pengunjung berdasarkan rentang tanggal
        $visitorStats = $this->getVisitorStats($request);


        // Return data ke view
        return view('admin.pengunjung', [
            'title' => 'Pengunjung',
            'dailyVisitors' => $visitorStats['dailyVisitors'],
            'startDate' => $visitorStats['startDate'], // Pass formatted startDate
            'endDate' => $visitorStats['endDate'],
            'user' => $user,
            'produk' => $produk,
            'kategori' => $kategori,
            'tf' => $tf,
            'ingpo' => $ingpo,
        ]);
    }

    // public function filterVisitors(Request $request)
    // {
    //     $startDate = $request->input('startDate');
    //     $endDate = $request->input('endDate');
    //     // dd($startDate, $endDate);



    //     if (!$startDate || !$endDate) {
    //         return response()->json(['error' => 'Start date and end date are required.'], 400);
    //     }

    //     $filteredVisitors = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as count')
    //         ->whereBetween('created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])
    //         ->groupBy('date')
    //         ->orderBy('date', 'asc')
    //         ->get();

    //     // \Log::info("Filtered Visitors: ", $filteredVisitors->toArray()); // Log output

    //     return response()->json($filteredVisitors);
    // }





    public function index() {}

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

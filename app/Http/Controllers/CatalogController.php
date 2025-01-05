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
use App\Models\Kategori;
use Spatie\QueryBuilder\QueryBuilder;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query("status_code");
        $catalogFilter = $request->query("kategori");
        $kategori = Kategori::all();

        if ($query) {
            // Redirect to catalog without parameter
            return redirect('/catalog');
        }

        $selectedCount = 0;

        // Cek apakah input berasal dari modal (array)
        if ($catalogFilter && is_array($catalogFilter)) {
            // Jika input dari modal (kategori berupa array)
            $selectedCount = count($catalogFilter); // Hitung jumlah kategori yang dipilih
        } elseif (is_string($catalogFilter)) {
            // Jika input dari luar modal, ubah menjadi array untuk filter
            $catalogFilter = explode(',', $catalogFilter);
        } else {
            $catalogFilter = []; // Jika tidak ada input, set ke array kosong
        }

        // Query produk berdasarkan filter kategori
        $produkQuery = QueryBuilder::for(Produk::class)
            ->allowedFilters('kategori')
            ->when(!empty($catalogFilter) && $catalogFilter !== ['semua'], function ($query) use ($catalogFilter) {
                return $query->whereHas('kategori', function ($q) use ($catalogFilter) {
                    $q->whereIn('name', $catalogFilter); // Filter dengan kategori yang dipilih
                });
            });
        // Paginate the products with a specific limit (20 per page)
        $produk = $produkQuery->paginate(20);

        // Extract pagination data
        $produkItems = $produk->items();
        $currentPage = $produk->currentPage();
        $totalPages = $produk->lastPage();
        $firstPageUrl = $produk->url(1);
        $lastPageUrl = $produk->url($produk->lastPage());
        $previousPageUrl = $produk->previousPageUrl();
        $nextPageUrl = $produk->nextPageUrl();


        return view('halaman/all_produk', [
            'title' => 'Catalog',
            'ingpo' => Ingpo::all(),
            'kategori' => $kategori,
            'selectedCount' => $selectedCount,
            'produkItems' => $produkItems,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'firstPageUrl' => $firstPageUrl,
            'lastPageUrl' => $lastPageUrl,
            'previousPageUrl' => $previousPageUrl,
            'nextPageUrl' => $nextPageUrl,
            'produk' => $produk, // Pass the full pagination instance
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

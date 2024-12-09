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
        $kategori = Kategori::where("name", $catalogFilter);


        if ($query) {
            // Redirect to catalog without parameter
            return redirect('/catalog');
        }

        // Paginate produk with a specific limit
        // Build the query for Produk
        $produkQuery = QueryBuilder::for(Produk::class)
            ->allowedFilters('kategori') // Allow filtering by 'kategori'
            ->when($catalogFilter && $catalogFilter !== 'semua', function ($query) use ($catalogFilter) {
                // Apply filter for categories if it's not 'semua'
                return $query->whereHas('kategori', function ($q) use ($catalogFilter) {
                    $q->where('name', $catalogFilter); // Filter by category name
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

<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $request->validate([
            'name' => 'required|string',
        ]);

        // Check if a category with the same name already exists
        $existingCategory = Kategori::where('name', $request->name)->first();

        if ($existingCategory) {
            return redirect()->back()->withErrors(['name' => 'Kategori dengan nama tersebut sudah ada.'])->withInput();
        }

        // If not, create a new category
        $kategori = new Kategori([
            'name' => $request->name,
        ]);

        // Save the new category to the database
        $kategori->save();

        return redirect()->route('produk.index')->with('success', 'Kategori baru berhasil ditambah!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}

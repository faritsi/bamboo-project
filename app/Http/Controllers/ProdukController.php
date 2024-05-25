<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $produk = Produk::all();
        return view('admin.produk',[
            'title' => 'Produk'
        ],compact('produk', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Produk::all();
        return view('form.add-produk',[
            'title' => 'Tambah Produk'
        ],compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|string',
            'deskripsi' => 'required|string',
            'tokped' => 'required|string',
            'shopee' => 'required|string',
        ]);
        // balita::create($request->all());
        $produk = new produk([
            'judul' => $request->judul,
            'slug' => $request->slug,
            'image' => $request->image,
            'deskripsi' => $request->deskripsi,
            'tokped' => $request->tokped,
            'shopee' => $request->shopee,
        ]);
        // $balita = new balita($request->all());
        // dd($produk);
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Data Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}

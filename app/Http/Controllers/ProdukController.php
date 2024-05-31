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
        // Validasi input, pastikan 'image' adalah file dengan format yang benar
        $validated = $request->validate([
            'judul' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'deskripsi' => 'required|string',
            'tokped' => 'required|string',
            'shopee' => 'required|string',
        ]);

        // Cek apakah ada file gambar dalam request
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->move(public_path('images'), $imageName); // Pindahkan gambar ke folder public/images
            $validated['image'] = $imageName; // Simpan nama file gambar ke dalam array validated
        } else {
            return back()->withErrors(['image' => 'Image upload failed']);
        }

        // Buat objek model produk dengan data yang sudah divalidasi
        $produk = new Produk([
            'judul' => $validated['judul'],
            'slug' => $validated['slug'],
            'image' => $validated['image'],
            'deskripsi' => $validated['deskripsi'],
            'tokped' => $validated['tokped'],
            'shopee' => $validated['shopee'],
        ]);

        // Simpan objek model ke database
        $produk->save();

        // Redirect ke route produk.index dengan pesan sukses
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'slug' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'tokped' => 'required|string',
            'shopee' => 'required|string',
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

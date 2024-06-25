<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $pid = $this->generateRandomString1(25);
        // Validasi input, pastikan 'image' adalah file dengan format yang benar
        $request->validate([
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'tokped' => 'required|string',
            'shopee' => 'required|string',
        ]);

        $imagePath = null;
        if($request->file('image')) {
            $imagePath = $request->file('image')->store('produk-images');
        }

        // Buat objek model produk dengan data yang sudah divalidasi
        $produk = new Produk([
            'pid' => $pid,
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'jenis_produk' => $request->jenis_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'image' => $imagePath,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'tokped' => $request->tokped,
            'shopee' => $request->shopee,
        ]);
        // dd($produk);
        // Simpan objek model ke database
        $produk->save();

        // Redirect ke route produk.index dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk Berhasil ditambah');
    }
    private function generateRandomString1($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * Display the specified resource.
     */
    public function show($pid)
    {
        $produk = DB::table('produks')->where('pid', $pid)->get();
        return view ('produk_show.index', compact('produk'));
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
    public function update(Request $request, $pid)
    {
        $request->validate([
            'kode_produk' => 'string',
            'nama_produk' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'tokped' => 'required|string',
            'shopee' => 'required|string',
        ]);

        $image = $request->oldImage;

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image')->store('produk-images');
        }

        DB::table('produks')->where('pid', $pid)->update([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'jenis_produk' => $request->jenis_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'image' => $image,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'tokped' => $request->tokped,
            'shopee' => $request->shopee,
        ]);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pid)
    {
        // Retrieve the record
        $produk = DB::table('produks')->where('pid', $pid)->first();

        // Check if the record exists
        if ($produk) {
            // Delete the image from storage if it exists
            if ($produk->image) {
                Storage::delete($produk->image);
            }

            // Delete the record from the database
            DB::table('produks')->where('pid', $pid)->delete();
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

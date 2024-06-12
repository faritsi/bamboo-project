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
        $pid = $this->generateRandomString1(25);
        // Validasi input, pastikan 'image' adalah file dengan format yang benar
        $validated = $request->validate([
            // 'pid' => 'required|string',
            'judul' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
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
            'pid' => $pid,
            'judul' => $validated['judul'],
            'slug' => $validated['slug'],
            'harga' => $validated['harga'],
            'image' => $validated['image'],
            'deskripsi' => $validated['deskripsi'],
            'tokped' => $validated['tokped'],
            'shopee' => $validated['shopee'],
        ]);
        // dd($produk);
        // Simpan objek model ke database
        $produk->save();

        // Redirect ke route produk.index dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Data Berhasil ditambah');
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
        $barang = DB::table('produks')->where('pid', $pid)->get();
        return view ('produk_show.index', compact('barang'));
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
        // $validated = $request->validate([
        //     'pid' => 'required|string',
        //     'judul' => 'required|string|max:255',
        //     'slug' => 'required|string|max:255',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'deskripsi' => 'required|string|max:1000',
        //     'tokped' => 'required|string|max:255',
        //     'shopee' => 'required|string|max:255',
        // ]);
    
        // // Cari produk berdasarkan pid
        // $produk = Produk::findOrFail($pid);
    
        // // Cek apakah ada file gambar dalam request dan proses file tersebut
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        //     $validated['image'] = $imageName; // Simpan nama file baru
        // } else {
        //     $validated = array_except($validated, ['image']); // Hapus image dari array validated jika tidak ada file baru
        // }
    
        // // Update produk dengan data yang sudah divalidasi
        // $produk->update($validated);
    
        // // Redirect dengan pesan sukses
        // return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
        $request->validate([
            'pid' => 'required|string',
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string|max:1000',
            'harga' => 'required|integer',
            'tokped' => 'required|string|max:255',
            'shopee' => 'required|string|max:255',
        ]);
        $produk = DB::table('produks')->where('pid', $request->pid)->get();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $reuest['image'] = $imageName; // Simpan nama file baru
        } else {
            $reuest = array_except($reuest, ['image']); // Hapus image dari array validated jika tidak ada file baru
        }
        $produk =   DB::table('produks')->where('pid',$request->pid)->update([
            'judul' => $request->judul,
            'slug' => $request->slug,
            'image' => $reuest['image'],
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'tokped' => $request->tokped,
            'shopee' => $request->shopee,
        ]);
        // $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pid)
    {
        // $produk = Produk::findOrFail($id);
        $produk = DB::table('produks')->where('pid',$pid)->delete();
        // $produk = Produk::where('pid', $pid)->firstOrFail();
        // $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

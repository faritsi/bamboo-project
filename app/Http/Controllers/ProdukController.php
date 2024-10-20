<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $produk = Produk::all();
        $kategori = Kategori::all();
        return view('admin.produk', [
            'title' => 'Produk'
        ], compact('produk', 'user', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Produk::all();
        return view('form.add-produk', [
            'title' => 'Tambah Produk'
        ], compact('produk'));
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
            'kategori_id' => 'required|string',
            // 'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Validasi gambar
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'tokped' => 'required|string',
            'shopee' => 'required|string',
        ]);

        $imagePath = null;
        $imageName = $pid . '.' . $request->file('image')->getClientOriginalExtension();
        if ($request->file('image')) {
            $imagePath = $request->file('image')->storeAs('produk-images', $imageName, 'public');
        }

        // Buat objek model produk dengan data yang sudah divalidasi
        $produk = new Produk([
            'pid' => $pid,
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            // 'jenis_produk' => $request->jenis_produk,
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
    private function generateRandomString1($length = 10)
    {
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

    public function getProvinsi()
    {
        $client = new Client();
        try {
            $response = $client->request(
                'POST',
                'https://api.rajaongkir.com/starter/province',
                array(
                    'headers' => array(
                        'key' => '1a14ace5f65a3788c0ccf8115baed896'
                    )
                )
            );
        } catch (RequestException $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        print_r($array_result);
    }

    public function keranjang()
    {
        $produk = Produk::all();
        return view('cart_view.cart', compact('produk'));
    }

    public function TambahKeranjang(Request $request, $pid)
    {
        $produk = Produk::find($pid);

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$pid])) {
            $keranjang[$pid]['quantity']++;
        } else {
            $keranjang[$pid] = [
                "nama_produk" => $produk->nama_produk,
                "harga" => $produk->harga,
                "quantity" => 1
            ];
        }

        session()->put('keranjang', $keranjang);

        return response()->json([
            'message' => 'Produk ditambahkan ke keranjang!',
            'cart_count' => count($keranjang)
        ]);
    }

    public function syncCart(Request $request)
    {
        // Save the cart to the session
        session()->put('keranjang', $request->cart);
        return response()->json(['message' => 'Cart updated']);
    }


    public function show($nama_produk)
    {
        // $client = new Client();
        // $apiKey = '1a14ace5f65a3788c0ccf8115baed896'; // Ganti dengan API Key Anda

        // $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
        //     'headers' => [
        //         'key' => $apiKey,
        //         'content-type' => 'application/x-www-form-urlencoded',
        //     ],
        //     'form_params' => [
        //         'origin' => 501, // Kode kota asal
        //         'destination' => 130, // Kode kota tujuan
        //         'weight' => 1000, // Berat dalam gram
        //         'courier' => 'jne' // Kurir yang digunakan (jne, pos, tiki)
        //     ],
        // ]);

        // $body = json_decode($response->getBody(), true);

        // Ambil data biaya dari response API
        // $ongkir = $body['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        $produk = DB::table('produks')->where('nama_produk', $nama_produk)->get();
        return view('produk_show.index', compact('produk'));
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
            'kategori_id' => 'required|string',
            // 'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'tokped' => 'required|string',
            'shopee' => 'required|string',
        ]);

        // $image = $request->oldImage;
        $produk = DB::table('produks')->where('pid', $pid)->first();
        $image = null;
        if ($request->file('image')) {
            $imageNameEdit = $pid . '.' . $request->file('image')->getClientOriginalExtension();
            if ($produk->image) {
                Storage::delete($produk->image);
            }
            $image = $request->file('image')->storeAs('produk-images', $imageNameEdit, 'public');
        }

        DB::table('produks')->where('pid', $pid)->update([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            // 'jenis_produk' => $request->jenis_produk,
            'kategori_id' => $request->kategori_id,
            'jumlah_produk' => $request->jumlah_produk,
            'image' => $image ?? $produk->image,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'tokped' => $request->tokped,
            'shopee' => $request->shopee,
        ]);

        if ($request->pid && $request->quantity) {
            $keranjang = session()->get('keranjang');
            $keranjang[$request->pid]["quantity"] = $request->quantity;
            session()->put('keranjang', $keranjang);
            session()->flash('success', 'keranjang updated successfully');
        }

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
    public function remove(Request $request)

    {
        if ($request->pid) {
            $keranjang = session()->get('keranjang');
            if (isset($keranjang[$request->pid])) {
                unset($keranjang[$request->pid]);
                session()->put('keranjang', $keranjang);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}

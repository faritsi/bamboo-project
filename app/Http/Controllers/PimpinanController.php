<?php

namespace App\Http\Controllers;

use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Role;

class PimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $pimpinan = Pimpinan::all();
        return view('admin.pimpinan',[
            'title' => 'Pimpinan'
        ],compact('pimpinan', 'user'));
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
        $ppid = $this->generateRandomString1(25);
        // Validasi input, pastikan 'image' adalah file dengan format yang benar
        $validated = $request->validate([
            // 'pid' => 'required|string',
            'name' => 'required|string',
            'jabatan' => 'required|string',
            'deskripsi' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->move(public_path('images'), $imageName); // Pindahkan gambar ke folder public/images
            $validated['image'] = $imageName; // Simpan nama file gambar ke dalam array validated
        } else {
            return back()->withErrors(['image' => 'Image upload failed']);
        }

        $pimpinan = new Pimpinan([
            'ppid' => $ppid,
            'name' => $validated['name'],
            'jabatan' => $validated['jabatan'],
            'deskripsi' => $validated['deskripsi'],
            'image' => $validated['image'],
        ]);
        // dd($pimpinan);
        // Simpan objek model ke database
        $pimpinan->save();

        // Redirect ke route produk.index dengan pesan sukses
        return redirect()->route('pimpinan.index')->with('success', 'Data Berhasil ditambah');
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
    public function show(Pimpinan $pimpinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pimpinan $pimpinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ppid)
    {
        $request->validate([
            'ppid' => 'required|string',
            'name' => 'required|string',
            'jabatan' => 'required|string',
            'deskripsi' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $pimpinan = DB::table('pimpinans')->where('ppid', $request->ppid)->get();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $reuest['image'] = $imageName; // Simpan nama file baru
        } else {
            $reuest = array_except($reuest, ['image']); // Hapus image dari array validated jika tidak ada file baru
        }
        $pimpinan =   DB::table('pimpinans')->where('ppid',$request->ppid)->update([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
            'image' => $reuest['image'],
        ]);
        // $produk->update($request->all());
        return redirect()->route('pimpinan.index')->with('success', 'Proful berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ppid)
    {
        $pimpinan = DB::table('pimpinans')->where('ppid',$ppid)->delete();
        return redirect()->route('pimpinan.index')->with('success', 'Profil berhasil dihapus!');
    }
}

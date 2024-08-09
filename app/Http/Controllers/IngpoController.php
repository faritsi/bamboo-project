<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Role;

class IngpoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $ingpo = Ingpo::all();
        return view('admin.ingpo',[
            'title' => 'Info Lainnya'
        ],compact('ingpo', 'user'));
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
        $iid = $this->generateRandomString1(25);
        // Validasi input, pastikan 'image' adalah file dengan format yang benar
        $validated = $request->validate([
            // 'pid' => 'required|string',
            'email' => 'required|string',
            'nowa' => 'required|string',
        ]);

        $ingpo = new Ingpo([
            'iid' => $iid,
            'email' => $validated['email'],
            'nowa' => $validated['nowa'],
        ]);
        // dd($pimpinan);
        // Simpan objek model ke database
        $ingpo->save();

        // Redirect ke route produk.index dengan pesan sukses
        return redirect()->route('info.index')->with('success', 'Data Berhasil ditambah');
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
    public function show(Ingpo $ingpo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingpo $ingpo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingpo $ingpo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingpo $ingpo)
    {
        //
    }
}

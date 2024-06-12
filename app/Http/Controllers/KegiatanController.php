<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $kegiatan = Kegiatan::all();
        return view('admin.kegiatan',[
            'title' => 'Kegiatan'
        ],compact('kegiatan', 'user'));
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
            'image1' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image2' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image3' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image4' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image5' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image6' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image7' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image8' => 'nullable|mimes:png,jpg,jpeg,webp',
            'image9' => 'nullable|mimes:png,jpg,jpeg,webp',
        ]);
        
        if ($request->hasFile('image1')) {
            $image = $request->file('image1');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->move(public_path('images'), $imageName); // Pindahkan gambar ke folder public/images
            $validated['image1'] = $imageName; // Simpan nama file gambar ke dalam array validated
        } else {
            return back()->withErrors(['image1' => 'Image upload failed']);
        }

        Kegiatan::create([
            'image1' => $validated['image1'],
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Data Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        //
    }
}

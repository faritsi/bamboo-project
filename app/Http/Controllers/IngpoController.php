<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    public function update(Request $request, $id)
    {
        // Validate form data
        $request->validate([
            'image_header' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc_header' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'desc_slogan' => 'required|string|max:255',
            'image_about' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc_about' => 'required|string|max:255',
            'image_visi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc_visi' => 'required|string|max:255',
            'image_misi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc_misi' => 'required|string|max:255',
            'judul_service' => 'required|string|max:255',
            'desc_service' => 'required|string|max:255',
            
            'judul_produk' => 'required|string|max:255',
            'desc_produk' => 'required|string|max:255',
            'logo_footer' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_footer' => 'required|string|max:255',
            'desc_footer' => 'required|string|max:255',
        ]);

        // Find the existing layout data
        $ingpo = Ingpo::findOrFail($id);

        // Handle image uploads using the custom image naming format
        if ($request->hasFile('image_header')) {
            // Generate custom image name using a specific ID or custom logic
            $imageName = $id . '_header.' . $request->file('image_header')->getClientOriginalExtension();
            
            // Delete old image if exists
            if ($ingpo->image_header && Storage::exists('public/' . $ingpo->image_header)) {
                Storage::delete('public/' . $ingpo->image_header);
            }

            // Store the new image with a custom name
            $ingpo->image_header = $request->file('image_header')->storeAs('ingpo-images', $imageName, 'public');
        }

        if ($request->hasFile('image_about')) {
            $imageName = $id . '_about.' . $request->file('image_about')->getClientOriginalExtension();

            if ($ingpo->image_about && Storage::exists('public/' . $ingpo->image_about)) {
                Storage::delete('public/' . $ingpo->image_about);
            }

            $ingpo->image_about = $request->file('image_about')->storeAs('ingpo-images', $imageName, 'public');
        }

        if ($request->hasFile('image_visi')) {
            $imageName = $id . '_visi.' . $request->file('image_visi')->getClientOriginalExtension();

            if ($ingpo->image_visi && Storage::exists('public/' . $ingpo->image_visi)) {
                Storage::delete('public/' . $ingpo->image_visi);
            }

            $ingpo->image_visi = $request->file('image_visi')->storeAs('ingpo-images', $imageName, 'public');
        }

        if ($request->hasFile('image_misi')) {
            $imageName = $id . '_misi.' . $request->file('image_misi')->getClientOriginalExtension();

            if ($ingpo->image_misi && Storage::exists('public/' . $ingpo->image_misi)) {
                Storage::delete('public/' . $ingpo->image_misi);
            }

            $ingpo->image_misi = $request->file('image_misi')->storeAs('ingpo-images', $imageName, 'public');
        }

        

        if ($request->hasFile('logo_footer')) {
            $imageName = $id . '_footer.' . $request->file('logo_footer')->getClientOriginalExtension();

            if ($ingpo->logo_footer && Storage::exists('public/' . $ingpo->logo_footer)) {
                Storage::delete('public/' . $ingpo->logo_footer);
            }

            $ingpo->logo_footer = $request->file('logo_footer')->storeAs('ingpo-images', $imageName, 'public');
        }

        // Update other form fields
        $ingpo->desc_header = $request->desc_header;
        $ingpo->slogan = $request->slogan;
        $ingpo->desc_slogan = $request->desc_slogan;
        $ingpo->desc_about = $request->desc_about;
        $ingpo->desc_visi = $request->desc_visi;
        $ingpo->desc_misi = $request->desc_misi;
        $ingpo->judul_service = $request->judul_service;
        $ingpo->desc_service = $request->desc_service;
        
        $ingpo->judul_produk = $request->judul_produk;
        $ingpo->desc_produk = $request->desc_produk;
        $ingpo->judul_footer = $request->judul_footer;
        $ingpo->desc_footer = $request->desc_footer;

        // Save the updated layout
        $ingpo->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Layout updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingpo $ingpo)
    {
        //
    }
}

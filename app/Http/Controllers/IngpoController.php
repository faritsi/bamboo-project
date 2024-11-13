<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IngpoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $ingpo = Ingpo::all();
        return view('admin.ingpo', [
            'title' => 'Info Lainnya'
        ], compact('ingpo', 'user'));
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
        $iid = $this->generateRandomString(25);

        // Validasi input
        $validated = $request->validate([
            'email' => 'required|string',
            'nowa' => 'required|string',
        ]);

        $ingpo = new Ingpo([
            'iid' => $iid,
            'email' => $validated['email'],
            'nowa' => $validated['nowa'],
        ]);

        // Simpan objek model ke database
        $ingpo->save();

        // Redirect ke route produk.index dengan pesan sukses
        return redirect()->route('info.index')->with('success', 'Data Berhasil ditambah');
    }

    private function generateRandomString($length = 10)
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
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
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

        // Array of fields for file uploads
        $fileFields = [
            'favicon' => 'favicon',
            'image_header' => 'header',
            'image_about' => 'about',
            'image_visi' => 'visi',
            'image_misi' => 'misi',
            'logo_footer' => 'footer',
        ];

        // Loop to handle file uploads
        foreach ($fileFields as $field => $suffix) {
            if ($request->hasFile($field)) {
                $imageName = $id . "_{$suffix}_" . time() . '.' . $request->file($field)->getClientOriginalExtension();

                // Delete old image if exists
                if ($ingpo->$field && Storage::exists('public/' . $ingpo->$field)) {
                    Storage::delete('public/' . $ingpo->$field);
                }

                // Store new image and update path
                $ingpo->$field = $request->file($field)->storeAs('ingpo-images', $imageName, 'public');
            }
        }

        // Update other form fields directly
        $ingpo->fill([
            'title' => $request->title,
            'desc_header' => $request->desc_header,
            'slogan' => $request->slogan,
            'desc_slogan' => $request->desc_slogan,
            'desc_about' => $request->desc_about,
            'desc_visi' => $request->desc_visi,
            'desc_misi' => $request->desc_misi,
            'judul_service' => $request->judul_service,
            'desc_service' => $request->desc_service,
            'judul_produk' => $request->judul_produk,
            'desc_produk' => $request->desc_produk,
            'judul_footer' => $request->judul_footer,
            'desc_footer' => $request->desc_footer,
        ]);

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

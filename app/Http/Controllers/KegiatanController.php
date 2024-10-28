<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\videokegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $video = videokegiatan::all();
        return view('admin.kegiatan', ['title' => 'Kegiatan'], compact('kegiatan', 'user', 'video'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'video_path' => 'nullable|string',
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $file) {
            $imageName = 'kegiatan-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('kegiatan-images', $imageName, 'public');

            Kegiatan::create([
                'image_path' => $imagePath,
            ]);
        }
    }
    $video = new videokegiatan([
        'video_path' => $request->video_path,
    ]);
    // dd($produk);
    $video->save();

    return redirect()->back()->with('success', 'Images uploaded successfully.');
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_path' => 'nullable|url', // Validasi untuk URL video
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($kegiatan->image_path) {
                Storage::delete($kegiatan->image_path);
            }

            // Handle image upload
            $image = $request->file('image');
            $imagePath = $image->store('kegiatan_images');
            $kegiatan->image_path = $imagePath;
            if ($request->video_path) {
                $kegiatan->video_path = $request->video_path;
            }
            $kegiatan->save();

            return response()->json(['success' => true, 'image_path' => asset('storage/' . $imagePath)]);
        }

        return response()->json(['success' => false, 'message' => 'No image found.']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id); // Check if the record exists
        if ($kegiatan) { // Delete the image from storage if it exists
            if ($kegiatan->image_path) {
                Storage::delete($kegiatan->image_path);
            }
            $kegiatan->delete();
        } // Storage::disk('kegiatan_images')->delete($image->image_path);

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}

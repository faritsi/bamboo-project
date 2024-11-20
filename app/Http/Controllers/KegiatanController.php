<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\videokegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        // dd("TEST before validate");
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_path' => 'nullable|url',
            // Bikin Buat Input Video file jadi gkg cmn URL YT aja
        ]);

        // Handle image uploads
        if ($request->hasFile('image')) {
            // dd($request->file('image'));
            foreach ($request->file('image') as $index => $file) {
                $imageName = 'kegiatan-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('kegiatan-images', $imageName, 'public');


                Kegiatan::create([
                    'image_path' => $imagePath,
                ]);
            }
        }

        // Process and store video URL
        if ($request->video_path) {
            $embedUrl = $this->convertYoutubeLinkToEmbed($request->video_path);
            if ($embedUrl) {
                videokegiatan::create([
                    'video_path' => $embedUrl,
                ]);
            } else {
                return redirect()->back()->withErrors(['video_path' => 'Invalid YouTube URL.']);
            }
        }

        return redirect()->back()->with('success', 'Images or video Uploaded Successfully.');
    }

    /**
     * Convert a YouTube link to an embeddable URL.
     */
    private function convertYoutubeLinkToEmbed($url)
    {
        // Match and extract video ID from various YouTube URL patterns
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/.*v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } else {
            return null;  // Return null if the URL doesn't match YouTube patterns
        }

        // Construct and return the embeddable URL
        return 'https://www.youtube.com/embed/' . $videoId;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);


        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_path' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($kegiatan->image_path) {
                Storage::delete('public/' . $kegiatan->image_path);
            }

            $image = $request->file('image');
            // Handle image upload
            $imageName = 'kegiatan-' . time() . '-' . $kegiatan->id . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('kegiatan-images', $imageName, 'public');
            $kegiatan->image_path = $imagePath;
        }

        if ($request->video_path) {
            $embedUrl = $this->convertYoutubeLinkToEmbed($request->video_path);
            if ($embedUrl) {
                $kegiatan->video_path = $embedUrl;
            } else {
                return redirect()->back()->withErrors(['video_path' => 'Invalid YouTube URL.']);
            }
        }

        $kegiatan->save();

        return redirect()->back()->with('success', 'Images or video Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->image_path) {
            Storage::delete('public/' . $kegiatan->image_path);
        }

        // Hapus video path
        if ($kegiatan->video_path) {
            $kegiatan->video_path = null; // Hapus URL dari database
        }

        $kegiatan->delete();

        return redirect()->back()->with('success', 'Images or video Delete Successfully.');
    }
}

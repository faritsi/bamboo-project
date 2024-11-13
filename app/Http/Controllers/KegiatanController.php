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
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_path' => 'nullable|url',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
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

        return redirect()->back()->with('success', 'Images and video uploaded successfully.');
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
                Storage::delete($kegiatan->image_path);
            }

            // Handle image upload
            $image = $request->file('image');
            $imagePath = $image->store('kegiatan_images');
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

        return redirect()->back()->with('success', 'Kegiatan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->image_path) {
            Storage::delete($kegiatan->image_path);
        }
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}

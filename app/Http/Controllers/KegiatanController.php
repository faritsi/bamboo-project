<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
use App\Models\Kegiatan;
use App\Models\videokegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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
        $ingpo = Ingpo::all();

        return view('admin.kegiatan', ['title' => 'Kegiatan'], compact('kegiatan', 'user', 'video', 'ingpo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd("TEST before validate");
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_link' => 'nullable|url',
            'video_path' => 'nullable|mimes:mov,mp4,avi,mkv|max:20480', //20mb
        ]);

        $videoPath = null;
        $embedUrl = null;

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
        // Proses file video dan link YouTube

        if ($request->hasFile('video_path')) {
            // Simpan video ke folder kegiatan-videos
            $videoFile = $request->file('video_path');
            $videoName = 'kegiatan-' . time() . '.' . $videoFile->getClientOriginalExtension();
            $videoPath = $videoFile->storeAs('kegiatan-videos', $videoName, 'public');
        }

        // Handle YouTube video link
        if ($request->filled('video_link')) {
            $embedUrl = $this->convertYoutubeLinkToEmbed($request->video_link);
            if (!$embedUrl) {
                return redirect()->back()->withErrors(['video_link' => 'Invalid YouTube URL.']);
            }
        }

        // Jika tidak ada video file atau link, kembalikan error
        if (!$videoPath && !$embedUrl) {
            return redirect()->back()->withErrors(['video_path' => 'Please provide a valid video file or YouTube URL.']);
        }

        // Simpan ke database
        VideoKegiatan::create([
            'video_link' => $embedUrl, // URL video YouTube yang sudah dikonversi
            'video_path' => $videoPath, // Path ke video yang disimpan di folder
        ]);

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

    // private function processVideoFile($file)
    // {
    //     FFMpeg::fromDisk('local')
    //         ->open($file)
    //         ->export()
    //         ->toDisk('local')
    //         ->inFormat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
    //         ->save('videos/compressed/' . $file->getClientOriginalName());
    //     try {
    //         $originalPath = $file->storeAs('videos/original', $file->getClientOriginalName(), 'public');
    //         $compressedPath = 'videos/compressed/' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_compressed.mp4';

    //         $ffmpeg = FFProbe::create([
    //             'ffmpeg.binaries'  => '/path/to/ffmpeg',  // Path to ffmpeg executable
    //             'ffprobe.binaries' => '/path/to/ffprobe', // Path to ffprobe executable
    //             'timeout'          => 3600,              // Optional: timeout in seconds
    //             'ffmpeg.threads'   => 12,                // Optional: number of threads
    //         ]);
    //         $video = $ffmpeg->open(storage_path('app/public/' . $originalPath));
    //         $video->filters()->resize(new FFMpeg\Coordinate\Dimension(1280, 720))->synchronize();
    //         $video->save(new FFMpeg\Format\Video\X264(), storage_path('app/public/' . $compressedPath));

    //         return $compressedPath;
    //     } catch (RuntimeException $e) {
    //         return redirect()->back()->withErrors(['file_video' => 'Video compression failed: ' . $e->getMessage()]);
    //     }
    // }


    /**
     * Update the specified resource in storage.
     */
    public function updateImage(Request $request, $id)
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

        $kegiatan->save();

        return redirect()->back()->with('success', 'Images or video Update Successfully.');
    }

    public function updateVideo(Request $request, $id)
    {
        // Cari video berdasarkan ID
        $video = VideoKegiatan::findOrFail($id);

        // Validasi input
        $request->validate([
            'video_path' => 'nullable|file|mimes:mov,mp4,avi,mkv|max:20480', // Max 20MB
            'video_link' => 'nullable|url',
        ]);

        // Proses file video jika diunggah
        if ($request->hasFile('video_path')) {
            // Hapus video lama jika ada dan file-nya benar-benar ada
            if ($video->video_path && Storage::exists('public/' . $video->video_path)) {
                Storage::delete('public/' . $video->video_path);
            }

            // Simpan video baru
            $uploadedFile = $request->file('video_path');
            $fileName = 'kegiatan-' . time() . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $uploadedFile->storeAs('kegiatan-videos', $fileName, 'public');

            // Set field database
            $video->video_path = $filePath;
            $video->video_link = null; // Reset link YouTube
        }
        // Proses YouTube link jika diberikan
        elseif ($request->filled('video_link')) {
            // Hapus file video lama jika ada
            if ($video->video_path && Storage::exists('public/' . $video->video_path)) {
                Storage::delete('public/' . $video->video_path);
            }

            // Konversi YouTube link ke embed URL
            $embedUrl = $this->convertYoutubeLinkToEmbed($request->video_link);
            if (!$embedUrl) {
                return redirect()->back()->withErrors(['video_link' => 'Invalid YouTube URL.']);
            }

            // Set field database
            $video->video_link = $embedUrl;
            $video->video_path = null; // Reset video file
        } else {
            return redirect()->back()->withErrors(['video_path' => 'Please provide a valid video file or YouTube URL.']);
        }

        // Simpan perubahan ke database
        $video->save();

        return redirect()->back()->with('success', 'Video updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroyImage($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->image_path) {
            Storage::delete('public/' . $kegiatan->image_path);
        }

        $kegiatan->delete();

        return redirect()->back()->with('success', 'Images or video Delete Successfully.');
    }

    public function destroyVideo($id)
    {
        $video = videokegiatan::findOrFail($id);
        if (!$video) {
            return redirect()->back()->withErrors(['error' => 'Data not found.']);
        }

        if ($video->video_path) {
            Storage::delete('public/' . $video->video_path);
        }

        $video->delete();

        return redirect()->back()->with('success', 'Video Deleted Successfully.');
    }
}

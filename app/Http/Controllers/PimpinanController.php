<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        $ingpo = Ingpo::all();

        return view('admin.pimpinan', [
            'title' => 'Pimpinan'
        ], compact('pimpinan', 'user', 'ingpo'));
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
        $request->validate([
            // 'ppid' => $ppid,
            'name' => 'required|string|max:5000',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:5000',
            'image' => 'image|max:5120'
        ]);

        $imagePath = null;
        $imageName = $ppid . '.' . $request->file('image')->getClientOriginalExtension();
        if ($request->file('image')) {
            $imagePath = $request->file('image')->storeAs('pimpinan-images', $imageName, 'public');
        }

        $pimpinan = new Pimpinan([
            'ppid' => $ppid,
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
            'image' => $imagePath
        ]);
        // dd($pimpinan);
        $pimpinan->save();

        return redirect()->route('pimpinan.index')->with('success', 'Pimpinan added successfully.');
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
            'name' => 'required|string',
            'jabatan' => 'required|string',
            'deskripsi' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $pimpinan = DB::table('pimpinans')->where('ppid', $ppid)->first();
        $image = null;
        if ($request->file('image')) {
            $imageNameEdit = $ppid . '.' . $request->file('image')->getClientOriginalExtension();
            if ($pimpinan->image) {
                Storage::delete($pimpinan->image);
            }
            $image = $request->file('image')->storeAs('pimpinan-images', $imageNameEdit, 'public');
        }

        DB::table('pimpinans')->where('ppid', $ppid)->update([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
            'image' => $image ?? $pimpinan->image,
        ]);

        return redirect()->route('pimpinan.index')->with('success', 'Pimpinan updated successfully.');
    }


    public function destroy($ppid)
    {
        // Retrieve the record
        $pimpinan = DB::table('pimpinans')->where('ppid', $ppid)->first();

        // Check if the record exists
        if ($pimpinan) {
            // Delete the image from storage if it exists
            if ($pimpinan->image) {
                Storage::delete($pimpinan->image);
            }

            // Delete the record from the database
            DB::table('pimpinans')->where('ppid', $ppid)->delete();
        }

        return redirect()->route('pimpinan.index')->with('success', 'Pimpinan deleted successfully.');
    }
}

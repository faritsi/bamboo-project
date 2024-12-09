<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ingpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = role::all();
        $ingpo = Ingpo::all();
        $users = User::all();
        return view('admin.adminForm', [
            'title' => 'Admin'
        ], compact('user', 'users', 'role', 'ingpo'));
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
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
            'role_id' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $imagePath = null;
        if ($request->file('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('admin-images', $imageName, 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'image' => $imagePath,
        ]);
        // dd($user);
        // Save the model to the database
        // $user->save();

        // Redirect to the admin index route with a success message
        return redirect()->route('admin.index')->with('success', 'Data Admin Berhasil Ditambah');
        return back()->withErrors([
            'username' => 'Username telah terdaftar!',
            'password' => 'Password tidak cocok',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'role_id' => 'required|integer|exists:roles,id',
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        // Data yang akan diperbarui
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'role_id' => $request->role_id,
        ];

        // Jika password diisi, maka masukkan dalam array data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Proses gambar baru jika ada
        if ($request->file('image')) {
            $imageName = $id . '.' . $request->file('image')->getClientOriginalExtension();

            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Simpan gambar baru dan tambahkan ke array data
            $data['image'] = $request->file('image')->storeAs('admin-images', $imageName, 'public');
        }

        // Update data pengguna
        $user->update($data);

        return redirect()->route('admin.index')->with('success', 'Data Admin Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            if ($user->image) {
                Storage::delete($user->image);
            }
            $user->delete();
        }
        return redirect()->route('admin.index')->with('success', 'Data Admin Berhasil Dihapus');
    }
}

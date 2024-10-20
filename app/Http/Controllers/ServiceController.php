<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $service = Service::all();
        return view('admin.service_view.services_view', [
            'title' => 'service'
        ], compact('service', 'user'));
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
            'img' => 'required|max:5120',
            'judul' => 'required',
            'desc' => 'required',
        ]);

        $imagePath = null;
        $imageName = uniqid() . '.' . $request->file('img')->getClientOriginalExtension();
        if ($request->file('img')) {
            $imagePath = $request->file('img')->storeAs('service-images', $imageName, 'public');
        }
        $service = new Service([
            'img' => $imagePath,
            'judul' => $request->judul,
            'desc' => $request->desc,
        ]);
        // dd($pimpinan);
        $service->save();
        return redirect()->route('services.index')->with('success', 'Service added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'img' => 'nullable|image|max:5120',
            'judul' => 'required|string',
            'desc' => 'required|string',
        ]);

        $service = Service::findOrFail($id);

        // Update the image if a new one is uploaded
        if ($request->file('img')) {
            $imageNameEdit = $id . '.' . $request->file('img')->getClientOriginalExtension();
            if ($service->img) {
                Storage::delete($service->img); // Delete old image
            }
            $service->img = $request->file('img')->storeAs('service-images', $imageNameEdit, 'public');
        }

        $service->judul = $request->judul;
        $service->desc = $request->desc;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        if ($service) {
            // Delete the image from storage if it exists
            if ($service->img) {
                Storage::delete($service->img);
            }

            // Delete the record from the database
            $service->delete();
        }

        return redirect()->route('services.index')->with('success', 'Pimpinan deleted successfully.');
    }
}

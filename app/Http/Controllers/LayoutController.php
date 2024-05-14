<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        return view('halaman.dashboard')->with([
            'title' => 'Dashboard'
        ]);
    }
}

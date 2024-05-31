<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('halaman/login');
});

// Dashboard Admin
Route::get('/dashboard-home', function () {
    return view('halaman/dashboard-home');
})->name('home');

Route::get('/dashboard-admin', function () {
    return view('halaman/dashboard-admin');
})->name('admin');

Route::get('/dashboard-produk', function () {
    return view('halaman/dashboard-produk');
})->name('produk');

Route::get('/dashboard-kegiatan', function () {
    return view('halaman/dashboard-kegiatan');
})->name('kegiatan');

Route::get('/dashboard-pimpinan', function () {
    return view('halaman/dashboard-pimpinan');
})->name('pimpinan');

Route::get('/dashboard-lainnya', function () {
    return view('halaman/dashboard-info-lainnya');
})->name('info-lainnya');

// Route::controller(LayoutController::class)->group(function({
//     Route::get('dashboard',  {
        
//     });
// }));
Route::controller(LayoutController::class)->group(function(){
    Route::get('dashboard', 'index');
});
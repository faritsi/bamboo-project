<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\IngpoController;
use App\Http\Controllers\TransaksiController;

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

Route::get('/konfirmasi', function () {
    return view('konfirmasi/index');
});
Route::get('/login', function () {
    return view('halaman/login');
});
Route::get('/admin', function () {
    return view('halaman/dashboard-admin');
});

// Dashboard Depan
Route::get('/catalog', function () {
    return view('halaman/all_produk');
});

Route::get('/detail-produk', function () {
    return view('halaman/detail-produk');
});

Route::get('/checkout', function () {
    return view('halaman/checkout-page');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});

Route::controller(LayoutController::class)->group(function () {
    Route::get('dashboard', 'halu');
});

// NEW DASHBOARD

Route::get('/halaman-utama', function () {
    return view('halaman/new-dashboard');
});


Route::get('/produk/{pid}', [ProdukController::class, 'show'])->name('produk.show');

// Route::group(['middleware' => ['auth']], function () {
//     Route::group(['middleware' => ['CekAuth:1,2']], function () {
//     Route::resource('home', LayoutController::class);
//     Route::resource('produk', ProdukController::class);      
//     Route::resource('kegiatan', KegiatanController::class);      
//     Route::resource('admin', AdminController::class);      
//     });
//     Route::group(['middleware' => ['CekAuth:2']], function () {
//     Route::resource('home', LayoutController::class);
//     Route::resource('produk', ProdukController::class);      
//     Route::resource('kegiatan', KegiatanController::class);      
//     });
// });
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['CekAuth:1,2']], function () {
        // Route::resource('home', LayoutController::class);
        Route::controller(LayoutController::class)->group(function () {
            Route::get('home', 'index');
            Route::get('sidebar', 'sidebar');
        });
        Route::get('/transactions', [TransaksiController::class, 'index']);
        Route::resource('produk', ProdukController::class);
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('pimpinan', PimpinanController::class);
        Route::resource('info', IngpoController::class);
    });
});

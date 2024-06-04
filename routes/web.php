<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\IngpoController;

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
Route::get('/admin', function () {
    return view('halaman/dashboard-admin');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});

Route::controller(LayoutController::class)->group(function(){
    Route::get('dashboard', 'halu');
});

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
        Route::resource('home', LayoutController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('pimpinan', PimpinanController::class);
        Route::resource('info', IngpoController::class);
    });
});


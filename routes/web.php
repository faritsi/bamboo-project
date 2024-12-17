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
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\coba;
use App\Http\Controllers\IntegrasiController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransaksiMidtrans;
use App\Http\Controllers\VisitorController;

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
// Route::get('/catalog', function () {
//     return view('halaman/all_produk');
// });

// ROUTE CATALOG LAMA
// Route::controller(CatalogController::class)->group(function () {
//     Route::get('catalog', 'index');
// });

Route::controller(CatalogController::class)->group(function () {
    Route::get('catalog', 'index')->name('catalog.index');
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

Route::post('/create-transaction', [TransaksiController::class, 'createTransaction']);


// NAMBAH NAME BUAT ROUTE DARI DETAIL PRODUK
Route::controller(LayoutController::class)->group(function () {
    Route::get('dashboard', 'halu')->name('dashboard.index');
});

// Route::get('/coba', [coba::class, 'getCity']);
Route::get('/provinces', [coba::class, 'getProvinces']);
Route::get('/cities/{province_id}', [coba::class, 'getCities']);
Route::post('/cost', [coba::class, 'getCost']);

// Route::get('/produk/{pid}', [ProdukController::class, 'show'])->name('produk.show');
// Route::post('/produk/{pid}', [ProdukController::class, 'show']);
Route::get('/produk/{nama_produk}', [ProdukController::class, 'show'])->name('produk.show');
Route::post('/produk/{nama_produk}', [ProdukController::class, 'show']);

Route::get('/keranjang', [ProdukController::class, 'keranjang']);
Route::post('/tambah-keranjang/{pid}', [ProdukController::class, 'TambahKeranjang']);
Route::post('/sync-cart', [ProdukController::class, 'syncCart'])->name('sync.cart');

Route::get('/error-400', function () {
    abort(400); // Memicu error 404 (Page Not Found)
});

Route::get('/error-404', function () {
    abort(404); // Memicu error 404 (Page Not Found)
});

Route::get('/error-403', function () {
    abort(403); // Memicu error 403 (Forbidden)
});

// Route::get('/error-419', function () {
//     abort(419); // Memicu error 403 (Forbidden)
// });

// Route::get('/error-500', function () {
//     abort(500); // Memicu error 500 (Internal Server Error)
// });

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
            // Route::get('/integrasi', [IntegrasiController::class, 'index'])->name('integrasi.index');
        });
        Route::get('/integrasi', [IntegrasiController::class, 'index'])->name('integrasi.index');
        Route::get('/transactions', [TransaksiController::class, 'index']);
        Route::get('/visitors/count', [VisitorController::class, 'getVisitorCount']);
        // Route::get('/visitors/filter', [VisitorController::class, 'filterVisitor'])->name('visitors.filter');
        Route::post('/visitor', [VisitorController::class, 'showStats'])->name('visitor.showStats');
        Route::get('/visitor', [VisitorController::class, 'showStats'])->name('visitor.showStats');
        Route::get('/transactions', [TransaksiController::class, 'index']);
        Route::get('/invoice/{orderId}', [TransaksiController::class, 'showInvoice'])->name('invoice.view');
        Route::post('/pembelian', [TransaksiController::class, 'view_tf'])->name('pembelian.sales');
        Route::get('/pembelian', [TransaksiController::class, 'view_tf'])->name('pembelian.sales');
        Route::resource('produk', ProdukController::class);
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('pimpinan', PimpinanController::class);
        Route::resource('info', IngpoController::class);
        Route::resource('kategori', KategoriController::class);
        Route::delete('/kegiatan/image/{id}', [KegiatanController::class, 'destroyImage'])->name('kegiatan.destroyImage');
        Route::delete('/kegiatan/video/{id}', [KegiatanController::class, 'destroyVideo'])->name('kegiatan.destroyVideo');
        Route::patch('/kegiatan/video/{id}', [KegiatanController::class, 'updateVideo'])->name('kegiatan.updateVideo');
        Route::patch('/kegiatan/image/{id}', [KegiatanController::class, 'updateImage'])->name('kegiatan.updateImage');
        Route::resource('services', ServiceController::class);
    });
});

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
Route::get('/admin', function () {
    return view('halaman/dashboard-admin');
});

// Route::controller(LayoutController::class)->group(function({
//     Route::get('dashboard',  {
        
//     });
// }));
Route::controller(LayoutController::class)->group(function(){
    Route::get('dashboard', 'index');
});
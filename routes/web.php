<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// route profil
Route::resource('profil', ProfilController::class);
// route user
Route::resource('data-user',UserController::class);
// route kategori
Route::resource('kategori', KategoriController::class);
// member
Route::resource('member',MemberController::class);
// produk
Route::resource('produk',ProdukController::class);
Route::get('get-produk', [App\Http\Controllers\ProdukController::class, 'get_produk']);
Route::post('hapus-produk', [App\Http\Controllers\ProdukController::class, 'hapus_produk']);

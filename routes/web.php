<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;

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
Route::post('cari-produk', [App\Http\Controllers\ProdukController::class, 'cari_produk']);
Route::post('cetak-laporan-produk', [App\Http\Controllers\ProdukController::class, 'cetak_laporan']);
Route::post('hapus-produk', [App\Http\Controllers\ProdukController::class, 'hapus_produk']);
Route::post('ganti-foto-produk/{id}', [App\Http\Controllers\ProdukController::class, 'ganti_foto_produk']);

// pengeluaran
Route::resource('pengeluaran',PengeluaranController::class);
Route::post('cetak-laporan-pengeluaran', [App\Http\Controllers\PengeluaranController::class, 'cetak_laporan']);

// penjualan
Route::resource('penjualan',PenjualanController::class);
Route::post('cetak-laporan-penjualan', [App\Http\Controllers\PenjualanController::class, 'cetak_laporan']);

// POS
Route::resource('pos',PosController::class);
Route::post('show-cart', [App\Http\Controllers\PosController::class, 'show_cart']);
Route::post('show-form-cart', [App\Http\Controllers\PosController::class, 'show_form_cart']);
Route::post('add-cart', [App\Http\Controllers\PosController::class, 'add_cart']);
Route::post('kurang-cart', [App\Http\Controllers\PosController::class, 'kurang_cart']);
Route::post('hapus-cart', [App\Http\Controllers\PosController::class, 'hapus_cart']);
Route::post('simpan-penjualan', [App\Http\Controllers\PosController::class, 'simpan_penjualan']);
Route::post('cetak-faktur', [App\Http\Controllers\PosController::class, 'cetak_faktur']);
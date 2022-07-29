<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/demos/livesearch',[App\Http\Controllers\DemoController::class, 'liveSearch']);        

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index']);


Route::get('/barang_stok', [App\Http\Controllers\BarangController::class, 'index'])->name('barang_stok');
Route::get('/barang_stok/data', [App\Http\Controllers\BarangController::class, 'data'])->name('barang_stok-data');
Route::get('/barang_stok/form/{id?}', [App\Http\Controllers\BarangController::class, 'form'])->name('barang_stok-form');
Route::post('/barang_stok/save/{id?}', [App\Http\Controllers\BarangController::class, 'save'])->name('barang_stok-save');
Route::get('/barang_stok/delete/{id?}', [App\Http\Controllers\BarangController::class, 'delete'])->name('barang_stok-delete');


Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('pelanggan');
Route::get('/pelanggan/data', [App\Http\Controllers\PelangganController::class, 'data'])->name('pelanggan-data');
Route::get('/pelanggan/form/{id?}', [App\Http\Controllers\PelangganController::class, 'form'])->name('pelanggan-form');
Route::post('/pelanggan/save/{id?}', [App\Http\Controllers\PelangganController::class, 'save'])->name('pelanggan-save');
Route::get('/pelanggan/delete/{id?}', [App\Http\Controllers\PelangganController::class, 'delete'])->name('pelanggan-delete');


Route::get('/supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier');
Route::get('/supplier/data', [App\Http\Controllers\SupplierController::class, 'data'])->name('supplier-data');
Route::get('/supplier/form/{id?}', [App\Http\Controllers\SupplierController::class, 'form'])->name('supplier-form');
Route::post('/supplier/save/{id?}', [App\Http\Controllers\SupplierController::class, 'save'])->name('supplier-save');
Route::get('/supplier/delete/{id?}', [App\Http\Controllers\SupplierController::class, 'delete'])->name('supplier-delete');


Route::get('/barang_masuk', [App\Http\Controllers\BarangMasukController::class, 'index'])->name('barang_masuk');
Route::get('/barang_masuk/data', [App\Http\Controllers\BarangMasukController::class, 'data'])->name('barang_masuk-data');
Route::get('/barang_masuk/form/{id?}', [App\Http\Controllers\BarangMasukController::class, 'form'])->name('barang_masuk-form');
Route::post('/barang_masuk/save/{id?}', [App\Http\Controllers\BarangMasukController::class, 'save'])->name('barang_masuk-save');
Route::get('/barang_masuk/delete/{id?}', [App\Http\Controllers\BarangMasukController::class, 'delete'])->name('barang_masuk-delete');
Route::get('/barang_masuk/print/{id?}', [App\Http\Controllers\BarangMasukController::class, 'print'])->name('barang_masuk-print');
Route::post('/barang_masuk/print/date', [App\Http\Controllers\BarangMasukController::class, 'print_date'])->name('barang_masuk-print_date');


Route::get('/barang_masuk_detail/{id?}', [App\Http\Controllers\BarangMasukDetailController::class, 'index'])->name('barang_masuk_detail');
Route::get('/barang_masuk_detail/data/{id?}', [App\Http\Controllers\BarangMasukDetailController::class, 'data'])->name('barang_masuk_detail-data');
Route::get('/barang_masuk_detail/form/{id?}', [App\Http\Controllers\BarangMasukDetailController::class, 'form'])->name('barang_masuk_detail-form');
Route::post('/barang_masuk_detail/save/{id?}', [App\Http\Controllers\BarangMasukDetailController::class, 'save'])->name('barang_masuk_detail-save');
Route::get('/barang_masuk_detail/delete/{id?}', [App\Http\Controllers\BarangMasukDetailController::class, 'delete'])->name('barang_masuk_detail-delete');


Route::get('/barang_keluar', [App\Http\Controllers\BarangKeluarController::class, 'index'])->name('barang_keluar');
Route::get('/barang_keluar/data', [App\Http\Controllers\BarangKeluarController::class, 'data'])->name('barang_keluar-data');
Route::get('/barang_keluar/form/{id?}', [App\Http\Controllers\BarangKeluarController::class, 'form'])->name('barang_keluar-form');
Route::post('/barang_keluar/save/{id?}', [App\Http\Controllers\BarangKeluarController::class, 'save'])->name('barang_keluar-save');
Route::get('/barang_keluar/delete/{id?}', [App\Http\Controllers\BarangKeluarController::class, 'delete'])->name('barang_keluar-delete');
Route::get('/barang_keluar/print/{id?}', [App\Http\Controllers\BarangKeluarController::class, 'print'])->name('barang_keluar-print');
Route::post('/barang_keluar/print/date', [App\Http\Controllers\BarangKeluarController::class, 'print_date'])->name('barang_keluar-print_date');


Route::get('/barang_keluar_detail/{id?}', [App\Http\Controllers\BarangKeluarDetailController::class, 'index'])->name('barang_keluar_detail');
Route::get('/barang_keluar_detail/data/{id?}', [App\Http\Controllers\BarangKeluarDetailController::class, 'data'])->name('barang_keluar_detail-data');
Route::get('/barang_keluar_detail/form/{id?}', [App\Http\Controllers\BarangKeluarDetailController::class, 'form'])->name('barang_keluar_detail-form');
Route::post('/barang_keluar_detail/save/{id?}', [App\Http\Controllers\BarangKeluarDetailController::class, 'save'])->name('barang_keluar_detail-save');
Route::get('/barang_keluar_detail/delete/{id?}', [App\Http\Controllers\BarangKeluarDetailController::class, 'delete'])->name('barang_keluar_detail-delete');


Route::get('/users', [App\Http\Controllers\UserAccountController::class, 'index'])->name('users');
Route::get('/users/data', [App\Http\Controllers\UserAccountController::class, 'data'])->name('users-data');
Route::get('/users/form/{id?}', [App\Http\Controllers\UserAccountController::class, 'form'])->name('users-form');
Route::post('/users/save/{id?}', [App\Http\Controllers\UserAccountController::class, 'save'])->name('users-save');
Route::get('/users/delete/{id?}', [App\Http\Controllers\UserAccountController::class, 'delete'])->name('users-delete');

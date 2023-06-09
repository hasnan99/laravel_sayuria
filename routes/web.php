<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sayuria_controller;
use App\Http\Controllers\KeranjangController;
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

Route::get('beranda',[sayuria_controller::class,'v_beranda'])->name('beranda');

Route::get('produk',[sayuria_controller::class,'v_produk'])->name('produk');


Route::get('register',[sayuria_controller::class,'v_register'])->name('register');
Route::get('login',[sayuria_controller::class,'v_login'])->name('login');

Route::post('login',[sayuria_controller::class,'loginpost'])->name('login.post');
Route::post('register',[sayuria_controller::class,'registerpost'])->name('register.post');

Route::get('logout',[sayuria_controller::class,'logout'])->name('logout');

Route::get('cari',[sayuria_controller::class,'cari_produk'])->name('cari');

Route::get('detail/{id}',[sayuria_controller::class,'detail_produk'])->name('detail');

Route::get('profile',[sayuria_controller::class,'v_profile'])->name('profile');
Route::post('updateProfile', [sayuria_controller::class, 'updateProfile'])->name('update.profile');

Route::get('keranjang', [KeranjangController::class, 'viewkeranjang'])->name('keranjang');
Route::post('detail/addToKeranjang', [KeranjangController::class, 'addToKeranjang'])->name('addToKeranjang');
Route::post('updateKeranjang', [KeranjangController::class, 'updateKeranjang'])->name('updateKeranjang');
Route::get('removeFromKeranjang/{id}', [KeranjangController::class, 'removeFromKeranjang'])->name('removeFromKeranjang');
Route::get('order-detail', [KeranjangController::class, 'v_order'])->name('order-detail');
Route::post('orderplace', [KeranjangController::class, 'orderplace'])->name('orderplace');
Route::post('bayar', [KeranjangController::class, 'bayar'])->name('bayar');
Route::get('pesanan-saya', [KeranjangController::class, 'pesanan_saya'])->name('pesanan-saya');
Route::get('transfer', [KeranjangController::class, 'transfer'])->name('transfer');

Route::get('tentangKami', [sayuria_controller::class, 'viewTentangKami'])->name('tentangKami');

//admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('admin',[sayuria_controller::class,'tampil_produk'])->name('admin');
    Route::get('admin/user',[sayuria_controller::class,'tampil_user'])->name('admin.user');
    Route::post('admin/store', [sayuria_controller::class, 'tambah_produk'])->name('admin.tambah');
    Route::get('admin/edit/{id}/', [sayuria_controller::class, 'edit_produk']);
    Route::post('admin/update', [sayuria_controller::class, 'update_produk'])->name('admin.update');
    Route::get('admin/order/edit/{id}/', [sayuria_controller::class, 'edit_order']);
    Route::post('admin/order/update', [sayuria_controller::class, 'update_order'])->name('admin.order.update');
    Route::get('admin/destroy/{id}/', [sayuria_controller::class, 'hapus_produk']);
    Route::get('admin/destroy/user/{id}/', [sayuria_controller::class, 'hapus_user']);
    Route::get('logout_admin',[sayuria_controller::class,'logout_admin'])->name('logout.admin');
    Route::get('admin/order',[sayuria_controller::class,'tampil_order'])->name('admin.order');
});
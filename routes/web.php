<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sayuria_controller;
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

Route::get('/',[sayuria_controller::class,'v_beranda'])->name('beranda');

Route::get('register',[sayuria_controller::class,'v_register'])->name('register');
Route::get('login',[sayuria_controller::class,'v_login'])->name('login');

Route::post('login',[sayuria_controller::class,'loginpost'])->name('login.post');
Route::post('register',[sayuria_controller::class,'registerpost'])->name('register.post');

Route::get('logout',[sayuria_controller::class,'logout'])->name('logout');


route::get('test',function(){
    $sayur=DB::table('sayur')->get();
    return view('welcome',[
        'sayur'=>$sayur
    ]);
});

//admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('admin',[sayuria_controller::class,'tampil_produk'])->name('admin');
    Route::get('admin/user',[sayuria_controller::class,'tampil_user'])->name('admin.user');
    Route::post('admin/store', [sayuria_controller::class, 'tambah_produk'])->name('admin.tambah');
    Route::get('admin/edit/{id}/', [sayuria_controller::class, 'edit_produk']);
    Route::post('admin/update', [sayuria_controller::class, 'update_produk'])->name('admin.update');
    Route::get('admin/destroy/{id}/', [sayuria_controller::class, 'hapus_produk']);
    Route::get('admin/destroy/user/{id}/', [sayuria_controller::class, 'hapus_user']);
    Route::get('logout_admin',[sayuria_controller::class,'logout_admin'])->name('logout.admin');
});
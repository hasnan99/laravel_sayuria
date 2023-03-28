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
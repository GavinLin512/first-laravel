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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/form', function (){
    return view('front.form.form');
})->name('front.form');

// 自定義的route都需要放在 resource 之上，才不會進到 resource 內有定義路徑變數的 route，像是 show
Route::get('user/list',[\App\Http\Controllers\UserController::class, 'getUsers'])->name('user.list');
Route::resource('user', \App\Http\Controllers\UserController::class);
//Route::get('user/list',[\App\Http\Controllers\UserController::class, 'getUsers'])->name('user.list');
//Route::resource('test',\App\Http\Controllers\TestController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

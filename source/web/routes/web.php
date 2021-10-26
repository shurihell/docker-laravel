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
    return view('admin/auth/login');
});
Route::post('/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::any('/auth/logout',  [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register-form');
Route::post('/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

Route::get('/main', function () {
    return view('home');
});
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

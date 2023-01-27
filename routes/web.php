<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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





Route::middleware(['auth'])->group(function () {
    Route::get('/product/tambah', function () {
        return view('tambah_product');
    });
    Route::get('/', [ProductController::class, "index"])->name('home');

    Route::post('/product/tambah', [ProductController::class, "store"]);
    Route::get('/product/edit/{id}', [ProductController::class, "show_edit"])->where('id', '[0-9]+');
    Route::put('/product/edit/{id}', [ProductController::class, "edit"])->where('id', '[0-9]+');
    Route::delete('/product/delete/{id}', [ProductController::class, "delete"])->where('id', '[0-9]+');
    Route::post('/logout', [LoginController::class, "logout"]);
});

Route::middleware(['guest'])->group(function () {
    Route::post('/register', [LoginController::class, "register"]);
    Route::post('/login', [LoginController::class, "login"]);
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::get('/login', function () {
        return view('login');
    })->name('login');
});

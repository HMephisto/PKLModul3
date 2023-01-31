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
    Route::get('/', [ProductController::class, "showHome"])->name('home');
    Route::post('/logout', [LoginController::class, "logout"]);
    Route::prefix('product')->group(function () {
        Route::get('/add', [ProductController::class, "showAddProduct"]);
        Route::post('/add', [ProductController::class, "store"]);
        Route::get('/edit/{id}', [ProductController::class, "showEdit"])->where('id', '[0-9]+');
        Route::put('/edit/{id}', [ProductController::class, "edit"])->where('id', '[0-9]+');
        Route::delete('/delete/{id}', [ProductController::class, "delete"])->where('id', '[0-9]+');
        }
    );
});


Route::middleware(['guest'])->group(function () {
    Route::post('/register', [LoginController::class, "register"]);
    Route::get('/register', [LoginController::class, "showRegister"])->name('register');
    Route::post('/login', [LoginController::class, "login"]);
    Route::get('/login', [LoginController::class, "showLogin"])->name('login');
});

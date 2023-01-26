<?php

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



Route::get('/product/tambah', function() {
    return view('tambah_product');
});

Route::get('/', [ProductController::class, "index"])->name('home');
Route::post('/product/tambah', [ProductController::class, "store"]);
Route::get('/product/edit/{id}', [ProductController::class, "show_edit"])->where('id', '[0-9]+');
Route::put('/product/edit/{id}', [ProductController::class, "edit"])->where('id', '[0-9]+');
Route::delete('/product/delete/{id}', [ProductController::class, "delete"])->where('id', '[0-9]+');

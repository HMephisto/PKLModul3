<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'getAllProduct']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/{product_id}', [ProductController::class, 'getProductDetail']);
        Route::put('/{product_id}', [ProductController::class, 'edit']);
        Route::delete('/{product_id}', [ProductController::class, 'delete']);
    });
    Route::prefix('brands')->group(function () {
        Route::get('/', [BrandController::class, 'getAllBrand']);
        Route::post('/', [BrandController::class, 'store']);
        Route::get('/{brand_id}', [BrandController::class, 'getBrandDetail']);
        Route::put('/{brand_id}', [BrandController::class, 'edit']);
        Route::delete('/{brand_id}', [BrandController::class, 'delete']);
    });

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
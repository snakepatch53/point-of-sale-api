<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\ProductBuyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInController;
use App\Http\Controllers\ProductOutController;
use App\Http\Controllers\ProductSaleController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::resource('info', InfoController::class);

    Route::resource('entities', EntityController::class);
    Route::get('entities/find/{name}', [EntityController::class, 'find']);
    Route::post('entities/{id}', [EntityController::class, 'update']);

    Route::resource('users', UserController::class);
    Route::post('users/login', [UserController::class, 'login']);
    Route::post('users/logout', [UserController::class, 'logout']);
    Route::post('users/{id}', [UserController::class, 'update']);

    Route::resource('lockers', LockerController::class);
    Route::resource('supliers', SuplierController::class);
    Route::resource('clients', ClientController::class);

    Route::resource('products', ProductController::class);
    Route::post('products/{id}', [ProductController::class, 'update']);

    Route::resource('productBuys', ProductBuyController::class);
    Route::resource('productIns', ProductInController::class);
    Route::resource('productSales', ProductSaleController::class);
    Route::resource('productOuts', ProductOutController::class);

    // Combo controllers
    Route::post('combo/bulkSale', [ComboController::class, 'bulkSale']);
});

// Not Found
Route::fallback(function () {
    return response()->json(['Not Found!'], 404);
});

// all: GET
// http://localhost/laravel/point-of-sales-api/api/v1/users

// show: GET
// http://localhost/laravel/point-of-sales-api/api/v1/users/{{id}}

// insert: POST
// http://localhost/laravel/point-of-sales-api/api/v1/users

// update: PUT - pero si tiene una foto entonces es con POST
// http://localhost/laravel/point-of-sales-api/api/v1/users/{{id}}

// delete: DELETE
// http://localhost/laravel/point-of-sales-api/api/v1/users/{{id}}
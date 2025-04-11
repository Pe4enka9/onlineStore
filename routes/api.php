<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [UserController::class, 'registration']);
Route::post('/auth', [UserController::class, 'auth']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}/products', [CategoryController::class, 'products']);

Route::get('/products/{product}', [ProductController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::post('/products/{product}/buy', [ProductController::class, 'buy']);

    Route::post('/payments', [PaymentController::class, 'payment']);
    Route::post('/process-payment/{orderId}', [PaymentController::class, 'processPayment']);
    Route::post('/payment-webhook', [ProductController::class, 'finalPayment']);

    Route::get('/orders', [OrderController::class, 'userOrders']);
});

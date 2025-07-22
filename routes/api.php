<?php

use App\Http\Requests\API\OrderController;
use App\Http\Requests\API\ProductController;
use App\Http\Requests\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'store']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/products', [ProductController::class, 'show']);

Route::post('/orders', [OrderController::class, 'store']);

Route::get('/orders', [OrderController::class, 'index']);
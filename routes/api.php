<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Get Current User Data
    Route::get('/user', function () {
        return Auth::user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('product')->group(function () {
        Route::post('/new', [ProductController::class, 'createProduct']);
        Route::get('/{id}', [ProductController::class, 'getProduct']);
        Route::patch('/{id}', [ProductController::class, 'updateProduct']);
    });

});

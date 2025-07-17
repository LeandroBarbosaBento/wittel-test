<?php

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

Route::group(['prefix' => 'customers'], function () {
    Route::get('/', [\App\Http\Controllers\CustomerController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\CustomerController::class, 'store']);
    Route::get('/report', [\App\Http\Controllers\CustomerController::class, 'report']);
    Route::get('/{customer}', [\App\Http\Controllers\CustomerController::class, 'show']);
    Route::put('/{customer}', [\App\Http\Controllers\CustomerController::class, 'update']);
    Route::delete('/{customer}', [\App\Http\Controllers\CustomerController::class, 'destroy']);
});

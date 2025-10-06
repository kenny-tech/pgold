<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\RateController;


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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [UserController::class, 'register'])->name('customer.register');
        Route::post('login', [UserController::class, 'login'])->name('customer.login');
        Route::post('verify-otp', [UserController::class, 'verifyOtp'])->name('customer.verify.otp');
    });
});

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::prefix('rate')->group(function () {
        Route::post('calculate', [RateController::class, 'calculate'])->name('rate.calculate');
        Route::get('all', [RateController::class, 'getAllRates'])->name('rate.all');
    });
});

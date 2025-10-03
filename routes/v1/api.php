<?php

use App\Http\Controllers\API\V1\AppVersionController;
use App\Http\Controllers\API\V1\BeneficiaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\BillerController;
use App\Http\Controllers\API\V1\CommissionController;
use App\Http\Controllers\API\V1\FcmController;
use App\Http\Controllers\API\V1\FlwWebhookController;
use App\Http\Controllers\API\V1\ItemController;
use App\Http\Controllers\API\V1\NotificationController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\PaymentController;
use App\Http\Controllers\API\V1\RateController;
use App\Http\Controllers\API\V1\ReferralController;
use App\Http\Controllers\API\V1\SecurityController;
use App\Http\Controllers\API\V1\TransactionController;
use App\Http\Controllers\API\V1\VTPassVerificationController;
use App\Http\Controllers\API\V1\WalletController;
use Illuminate\Support\Facades\Artisan;

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

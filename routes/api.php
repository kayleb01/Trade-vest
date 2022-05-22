<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\UserWalletController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['jwt.verify'])->group(function () {
    Route::post('update-user', [AuthController::class, 'updateProfile']);

    /** -------------------- Contracts --------------------------- */
    Route::get('contracts', [ContractController::class, 'index']);
    Route::put('update-contract', [ContractController::class, 'update']);

    /**------------------------ User Wallet ---------------------- */
    Route::post('user-deposit', [UserWalletController::class, 'deposit']);
    Route::post('deposit-proof', [UserWalletController::class, 'uploadProof']);
    Route::put('wallet/update', [UserWalletController::class, 'updateWallet']);
});

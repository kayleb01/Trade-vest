<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BtcAddressController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\UserTransactionController;
use App\Http\Controllers\Api\WalletAddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return response('database migrated');
});
Route::post('register', [AuthController::class, 'register']);
    Route::get('contracts', [ContractController::class, 'index']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('contact', [ContactController::class, 'store']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('update-user', [AuthController::class, 'updateProfile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);

    /** -------------------- Contracts --------------------------- */
    Route::put('update-contract', [ContractController::class, 'update']);

    /**------------------------ User Wallet ---------------------- */
    Route::post('user-deposit', [UserTransactionController::class, 'deposit']);
    Route::post('deposit-proof', [UserTransactionController::class, 'uploadProof']);
    Route::put('transaction/update', [UserTransactionController::class, 'updateTransaction']);
    Route::get('user-transactions', [UserTransactionController::class, 'index']);
    Route::put('confirm-transaction', [UserTransactionController::class, 'confirmTransaction']);

    /**--------------------------- Admin section ---------------- */
    Route::get('users', [AdminController::class, 'getUsers']);
    Route::get('user/{id}', [AdminController::class, 'getUser']);
    Route::put('user/update-deposit', [AdminController::class, 'UpdateUserDeposit']);
    Route::put('user/update-earnings', [AdminController::class, 'UpdateUserEarnings']);
    Route::put('user/update-withdrawals', [AdminController::class, 'UpdateUserWithdrawals']);
    Route::delete('delete-user/{user}', [AdminController::class, 'destroy']);
    Route::get('user/{user}/transactions', [AdminController::class, 'userTransactions']);

    /**------------------- BTC Address ------------------------- */
    Route::post('wallet/store', [WalletAddressController::class, 'store']);
    Route::get('wallet/get-btc-address', [WalletAddressController::class, 'index']);
    Route::put('wallet/update-address', [WalletAddressController::class, 'update']);
});

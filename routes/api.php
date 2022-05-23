<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\UserTransactionController;
use App\Models\UserTransactions;
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
    Route::post('change-password', [AuthController::class, 'changePassword']);

    /** -------------------- Contracts --------------------------- */
    Route::get('contracts', [ContractController::class, 'index']);
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
    Route::put('update-wallet-user', [AdminController::class, 'updateUserWallet']);
    Route::delete('delete-user/{user}', [AdminController::class, 'destroy']);
});

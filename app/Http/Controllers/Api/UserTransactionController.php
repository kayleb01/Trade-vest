<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmTransaction;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\ProofUpload;
use App\Http\Requests\UpdateWallet;
use App\Http\Resources\DepositResource;
use App\Services\UserTransactionService;

class UserTransactionController extends Controller
{
    protected $service;

    public function __construct(UserTransactionService $service)
    {
        $this->service = $service;
    }

    public function deposit(DepositRequest $request)
    {
        return response()->json(
            [
                'message' => 'Deposit successful',
                'data' => new DepositResource($this->service->deposit($request->validated()))
            ]
        );
    }

    public function uploadProof(ProofUpload $request)
    {
        return response()->json([
            'message' => 'proof uploaded successfully',
            'data' => $this->service->uploadProof($request->validated())
        ]);
    }

    public function updateTransaction(UpdateWallet $request)
    {
        return response()->json([
            'message' => 'transaction updated successfully',
            'data' => $this->service->updateTransaction($request->validated())
        ]);
    }

    public function index()
    {
        $user_transaction = auth()->user()
            ->user_transactions()
            ->select(['amount', 'contract_id', 'proof', 'created_at'])
            ->latest()
            ->get();

        return response()->json(
            [
                'message' => 'user transaction transactions',
                'data' => $user_transaction->load('contract')
            ]
        );
    }

    public function confirmTransaction(ConfirmTransaction $request)
    {
        return response()->json([
            'message' => 'transaction confirmed successfully',
            'data' => $this->service->confirmTransaction($request->validated())
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\ProofUpload;
use App\Http\Requests\UpdateWallet;
use App\Http\Resources\DepositResource;
use App\Services\UserWalletService;

class UserWalletController extends Controller
{
    protected $service;

    public function __construct(UserWalletService $service)
    {
        $this->service = $service;
    }

    public function deposit(DepositRequest $request)
    {
        return response()->json(
            [
                'message' => 'Deposit successful',
                'created_at' => $this->created_at,
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

    public function updateWallet(UpdateWallet $request)
    {
        return response()->json([
            'message' => 'wallet updated successfully',
            'data' => $this->service->updateWallet($request->validated())
        ]);
    }
}

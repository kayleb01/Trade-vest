<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Http\Resources\DepositResource;
use App\Services\UserWalletService;
use Illuminate\Http\Request;

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
}

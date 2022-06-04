<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateContract;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use App\Services\ContractService;

class ContractController extends Controller
{
    protected $service;

    public function __construct(ContractService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
        $contracts = Contract::select(['id', 'name', 'min_amount', 'max_amount', 'weekly_returns', 'bonus', 'category'])
                                ->get()
                                ->groupBy('category');
        return response()->json(
            [
                'message' => 'contracts fetched successfully',
                'data' => $contracts
            ]
        );
    }

    public function update(updateContract $request)
    {
        return response()->json([
            'message' => 'contract updated successfully',
            'data' => new ContractResource($this->service->updateContract($request->validated()))
        ]);
    }
}

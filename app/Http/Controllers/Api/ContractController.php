<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::select(['name', 'min_amount', 'max_amount', 'weekly_returns', 'bonus', 'category'])
                                ->get()
                                ->groupBy('category');
        return response()->json(
            [
                'message' => 'contracts fetched successfully',
                'data' => $contracts
            ]
        );
    }
}

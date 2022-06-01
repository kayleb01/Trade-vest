<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BtcAddressRequest;
use App\Http\Requests\UpdateBtcAddressRequest;
use App\Models\BtcAddress;
use Illuminate\Http\Request;

class BtcAddressController extends Controller
{
    public function store(BtcAddressRequest $request)
    {
        if (BtcAddress::count() < 1) {
            $address = BtcAddress::create($request->validated());
        } else {
            abort(403, 'wallet address already exists, please update address');
        }

        return response()->json([
            'message' => 'wallet address added successfully',
            'data' => $address->only('wallet_address')
        ]);
    }

    public function index()
    {
        return response()->json([
            'message' => 'wallet address fetched successfully',
            'data' => BtcAddress::first()->only('wallet_address')
        ]);
    }

    public function update(UpdateBtcAddressRequest $request)
    {
        $address = BtcAddress::first();
        abort_if(
            !$address->update($request->validated()),
            500,
            'an error was encountered, please try again later'
        );
        return response()->json([
            'message' => 'wallet address updated successfully',
            'data' => $address->only('wallet_address')
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BtcAddressRequest;
use App\Http\Requests\UpdateBtcAddressRequest;
use App\Models\BtcAddress;
use App\Models\WalletAddress;

class WalletAddressController extends Controller
{
    public function store(BtcAddressRequest $request)
    {
        $id = 1;
        $walletAddress = WalletAddress::updateOrCreate(
            ['id' => $id],
            $request->validated()
        );

        abort_if(!$walletAddress, 500, 'An error occured, please try again');

        return response()->json([
            'message' => 'wallet address added successfully',
            'data' => $walletAddress->only('btc_address', 'eth_address', 'usdt_address')
        ]);
    }

    public function index()
    {
        return response()->json([
            'message' => 'wallet address fetched successfully',
            'data' => WalletAddress::first()->only('btc_address', 'eth_address', 'usdt_address')
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

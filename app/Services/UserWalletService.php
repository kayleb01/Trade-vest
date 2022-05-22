<?php
namespace App\Services;

use App\Models\Contract;
use App\Models\UserWallet;
use Illuminate\Support\Arr;

class UserWalletService
{
    public function deposit(array $depositData)
    {
        $user = auth()->user();
        $deposit = $user->wallet()->create($depositData);

        abort_if(!$deposit, 500, 'an error occured, please');

        return $deposit->load('contract');
    }

    public function uploadProof(array $proof)
    {
        $wallet = auth()
                        ->user()
                        ->wallet()
                        ->findOrFail($proof['wallet_id']);

        $file = $proof['proof'];
        $file->store('media/proof/'.now()->format('Y').'/'.now()->format('m'), 'public');
        $wallet->proof = $file->hashName();
        $wallet->save();

        return $wallet->load('contract');
    }

    public function updatewallet(array $walletData)
    {
        $deposit = UserWallet::findOrFail($walletData['wallet_id']);
        abort_if(!$deposit->update($walletData), 500, 'an error occured please try again later');

        return $deposit->only(['id', 'status', 'amount', 'user', 'ImageUrl']);
    }
}

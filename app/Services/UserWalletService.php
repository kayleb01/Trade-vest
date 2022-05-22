<?php
namespace App\Services;

use App\Models\Contract;

class UserWalletService
{
    public function deposit(array $depositData)
    {
        $user = auth()->user();
        $deposit = $user->wallet()->create($depositData);

        abort_if(!$deposit, 500, 'an error occured, please');

        return $deposit->load('contract');
    }
}

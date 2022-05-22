<?php
namespace App\Services;

use App\Models\UserTransactions;
use Illuminate\Support\Facades\DB;

class UserTransactionService
{
    public function deposit(array $depositData)
    {
        $user = auth()->user();
        $deposit = $user->user_transactions()->create($depositData);

        abort_if(!$deposit, 500, 'an error occured, please');

        return $deposit->load('contract');
    }

    public function uploadProof(array $proof)
    {
        $transaction = auth()
                    ->user()
                    ->user_transactions()
                    ->findOrFail($proof['transaction_id']);

        $file = $proof['proof'];
        $file->store('media/proof/'.now()->format('Y').'/'.now()->format('m'), 'public');
        $transaction->proof = $file->hashName();
        $transaction->save();

        return $transaction->load('contract');
    }

    public function updateTransaction(array $transactionData)
    {
        $deposit = UserTransactions::findOrFail($transactionData['transaction_id']);
        abort_if(!$deposit->update($transactionData), 500, 'an error occured please try again later');

        return $deposit->only(['id', 'status', 'amount', 'user', 'ImageUrl']);
    }

    public function confirmTransaction(array $transactionData)
    {
        return DB::transaction(function () use ($transactionData) {
            $transaction = UserTransactions::findOrFail($transactionData['transaction_id']);
            abort_if(!$transaction->update($transactionData), 500, 'an error occured please try again later');

            $user_wallet = $transaction->user->wallet;
            $amount  = ($user_wallet->amount + $transaction->amount);
            $user_wallet->amount = $amount;
            $user_wallet->save();

            return $transaction->only(['id', 'status', 'amount', 'user', 'ImageUrl']);
        });
    }
}

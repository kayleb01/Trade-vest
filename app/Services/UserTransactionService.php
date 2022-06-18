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
        $user = auth()->user();

        abort_if($user->user_transactions->isEmpty(), 400, 'you have no transaction to upload proof for');

        $file = $proof['proof'];
        $file->store('media/proof/'.now()->format('Y').'/'.now()->format('m'), 'public');
        $user->proof = $file->hashName();
        $user->save();

        return $user;
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

            $user_deposit = $transaction->user->deposit;
            // dd(!$user_deposit);
            //if the user has no deposit, add initial deposit
            if (!$user_deposit->initial) {
                $user_deposit->initial = $transaction->amount;
                $user_deposit->total = ($user_deposit->total + $transaction->amount);
                $user_deposit->save();
            } else {
                $amount = ($user_deposit->compunded + $transaction->amount);
                $user_deposit->compounded = $amount;
                $user_deposit->total += $amount;
                $user_deposit->save();
            }



            return $transaction->only(['id', 'status', 'initial', 'compounded', 'total', 'user', 'ImageUrl']);
        });
    }
}

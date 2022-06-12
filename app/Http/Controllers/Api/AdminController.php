<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateWalletRequest;
use App\Http\Resources\AdminUsers;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        abort_if(auth()->user()->role->name !=='admin', 401, 'Unauthorized');
    }

    public function getUsers()
    {
        $users = User::where('role_id', 2)
            ->select(['id', 'first_name', 'last_name', 'email', 'phone_number', 'role_id'])
            ->paginate(20);
        return response()->json(
            [
            'message' => 'users fetched successfully',
            'data' => $users->load(['role', 'wallet'])
            ]
        );
    }

    public function getUser($id)
    {
        $user = User::select(['id', 'first_name', 'last_name', 'email', 'phone_number', 'role_id'])
            ->where('id', $id)
            ->first();
        return response()->json(
            [
            'message' => 'user fetched successfully',
            'data' => $user->load(['role', 'wallet'])
            ]
        );
    }


    public function updateUserWallet(UpdateWalletRequest $request)
    {
        $users_wallet = UserWallet::where('user_id', $request->user_id)->first();
        abort_if(!$users_wallet || $users_wallet->amount == 0, 404, 'user has nothing in wallet');

        abort_if($request->amount > $users_wallet->amount, 400, 'Amount is greater than available balance');

        $users_wallet->amount = ($users_wallet->amount - $request->amount);
        $users_wallet->save();
        return response()->json(
            [
            'message' => 'users fetched successfully',
            'data' => $users_wallet
            ]
        );
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(
            [
                'message' => 'user deleted successfully.',
                'data' => null
            ]
        );
    }

    public function userTransactions(User $user)
    {
        return response()->json([
            'message' => 'Fetched user transactions',
            'data' => $user->user_transactions
        ]);
    }
}

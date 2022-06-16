<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserDeposit;
use App\Http\Requests\UpdateUserEarnings;
use App\Http\Requests\UpdateUserWithdrawals;
use App\Http\Resources\AdminUserResource;
use App\Http\Resources\AdminUsersResource;
use App\Http\Resources\AdminUserTransactions;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        abort_if(!auth()->user() || auth()->user()->role->name !=='admin', 401, 'Unauthorized');
    }

    public function getUsers()
    {
        $users = User::where('role_id', 2)
            ->select(['id', 'first_name', 'last_name', 'email', 'phone_number', 'role_id', 'proof', 'updated_at'])
            ->with(['user_transactions' => function ($q) {
                $q->latest();
            }])
            ->paginate(20);

        return response()->json(
            [
            'message' => 'users fetched successfully',
            'data' => AdminUserResource::collection($users->load(['role']))
            ]
        );
    }

    public function getUser($id)
    {
        $user = User::query()
            ->select(['id', 'first_name', 'last_name', 'email', 'phone_number', 'role_id', 'proof', 'updated_at'])
            ->where('id', $id)
            ->first();

        return response()->json(
            [
                'message' => 'user fetched successfully',
                'data' => new AdminUserResource($user->load(['role', 'deposit', 'earnings', 'withdrawals']))
            ]
        );
    }


    public function updateUserDeposit(UpdateUserDeposit $request)
    {
        $user = User::findOrFail($request->user_id);

        try {
            $user->deposit()->update($request->validated());
        } catch (\Exception $e) {
            return response()->json('an error occured, '.$e->getMessage());
        }

        return response()->json(
            [
            'message' => 'users deposit updated successfully',
            'data' => $user->deposit
            ]
        );
    }

    public function updateUserEarnings(UpdateUserEarnings $request)
    {
        $user = User::findOrFail($request->user_id);

        try {
            $user->earnings()->update($request->validated());
        } catch (\Exception $e) {
            return response()->json('an error occured, '.$e->getMessage());
        }

        return response()->json(
            [
            'message' => 'users earnings updated successfully',
            'data' => $user->earnings
            ]
        );
    }

    public function updateUserWithdrawals(UpdateUserWithdrawals $request)
    {
        $user = User::findOrFail($request->user_id);

        try {
            $user->withdrawals()->update($request->validated());
        } catch (\Exception $e) {
            return response()->json('an error occured, '.$e->getMessage());
        }

        return response()->json(
            [
            'message' => 'users withdrawals updated successfully',
            'data' => $user->withdrawals
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
            'data' => AdminUserTransactions::collection($user->user_transactions)
        ]);
    }
}

<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $userData)
    {
        return DB::transaction(function () use ($userData) {
            $create = User::create($userData);
            abort_if(!$create, 500, 'an error occured, please try again later');
            $create->wallet()->create();
            return $create;
        });
    }

    public function authenticate(string $username, string $password)
    {
        $email = $username;

        return Auth::attempt(compact('email', 'password'), true);
    }

    /**
    * Get a JWT via given credentials.
    *
    * @return array
    */
    public function authenticateStateless(string $email, string $password)
    {
        abort_if(! $token = $this->authenticate($email, $password), 400, 'Login credentials do not match our records');

        return $this->respondWithToken($token);
    }

    /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithToken($token)
    {
        $user = auth()->user();

        return [
            'user' => $user,
            'role' => $user->role->name,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'deposits' => $user->deposits,
            'earnings' => $user->earnings,
            'withdrawals' => $user->withdrawals,
        ];
    }

    public function changePassword(array $password)
    {
        $user = auth()->user();

        if (!Hash::check($password['old_password'], $user->password)) {
            abort(400, 'Invalid old password');
        } elseif (Hash::check(request('new_password'), $user->password)) {
            abort(400, 'Please enter a password which is not similar then current password.');
        } else {
            $user->update(['password' => $password['new_password']]);
            return $user;
        }
    }

    public function updateUserDetails(array $userData)
    {
        $user = Auth::user();
        if (!$user->update($userData)) {
            abort(500, 'An error occured, please try again later');
        }
        return $user;
    }
}

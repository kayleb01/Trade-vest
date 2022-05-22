<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateProfile;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Create user account
     *
     * @param CreateUser $request
     * @return \Illuminate\support\Facades\Response
     */
    public function register(CreateUser $request)
    {
        return response()->json([
            'message' => 'user created successfully',
            'data' => new RegisterResource($this->service->register($request->validated()))
        ]);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        return response()->json([
            'message' => "login successful",
            'data' => new LoginResource($this->service->authenticateStateless($email, $password))
        ]);
    }

    public function updateProfile(UpdateProfile $request)
    {
        return response()->json(
            [
                'message' => 'user updated successfully',
                'data' => new UserResource($this->service->updateUserDetails($request->validated()))
            ]
        );
    }
}

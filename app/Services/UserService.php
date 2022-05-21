<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public function register(array $userData)
    {
        $create = User::create($userData);
        abort_if(!$create, 500, 'an error occured, please try again later');

        return $create;
    }
}

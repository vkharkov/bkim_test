<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{

    public function __construct(private UserRepository $userRepository)
    {}


    public function registerByMail(RegisterRequest $request) : User
    {

        $user = new User();
        $user->fill([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => UserRole::User
        ]);
        $user->save();
        return $user;

    }

    public function registerByPhone(RegisterRequest $request) : User
    {

        $user = new User();
        $user->fill([
            'phone' => $request->get('phone'),
            'role' => UserRole::User
        ]);
        $user->save();
        return $user;

    }

    public function makeAdmin(User $user) : User
    {

        $user->update([
            'role' => UserRole::Admin
        ]);

        return $user;

    }

    public function removeAdmin(User $user) : User
    {

        $user->update([
            'role' => UserRole::User
        ]);

        return $user;

    }


}

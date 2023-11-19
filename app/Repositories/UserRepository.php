<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{

    public function getAuthorizedUser(): User
    {
        return User::where('id','=', Auth::id())->first();
    }

    public function findByEmail($email): User|null
    {
        return User::where('email','=', $email)->first();
    }

    public function findByPhone($phone): User|null
    {
        return User::where('phone','=', $phone)->first();
    }

}

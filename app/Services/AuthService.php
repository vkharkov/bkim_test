<?php

namespace App\Services;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\PhoneAuthRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthService
{

    public function __construct(private UserRepository $userRepository)
    {}

    public function loginWithEmail(AuthRequest $request)
    {

        $user = $this->userRepository->findByEmail($request->get('email'));

        if ( !empty($user) && password_verify($request->get('password'), $user->password) ){
            Auth::guard()->login($user);
            return $this->makeBearerToken($user);
        }

        throw new \Exception('User not found');

    }

    public function sendPhoneCode(AuthRequest $request) : bool
    {
        $user = $this->userRepository->findByPhone($request->get('phone'));

        if ( !empty($user) ){
            $user->update([
                'auth_code' => Str::substr($user->phone, 0, -4),
                'auth_code_expire_at' => now()->addMinutes(10)
            ]);
            return true;
        }

        throw new \Exception('User not found');

    }

    public function loginWithPhone(PhoneAuthRequest $request)
    {

        $user = $this->userRepository->findByPhone($request->get('email'));

        if ( !empty($user) &&
            $request->get('code') == $user->auth_code &&
            now()->isBefore($user->auth_code_valid_till) )
        {
            Auth::guard()->login($user);
            return $this->makeBearerToken($user);
        }

        throw new \Exception('User not found');

    }

    private function makeBearerToken(User $user) : string
    {

        return $user->createToken('APIToken')->plainTextToken;

    }

}

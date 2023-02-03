<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{

    public function login(mixed $request): array
    {
        $credentials = $request->validated();

        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {

            $user = Auth::user();

            $token = $user->createToken('authToken')->plainTextToken;

            return [
                'status' => true,
                'token' => $token,
                'type' => 'Bearer Token'
            ];
        };
        return [
            'status' => false
        ];
    }

    public function register(mixed $request): array
    {
        $userInfo = $request->validated();
        
        return [];
    }
}

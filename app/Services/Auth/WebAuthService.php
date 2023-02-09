<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WebAuthService implements IAuthService
{
    public function login(mixed $request): array
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:10',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'errors' => $validator->errors()->toArray()
            ];
        }

        if (Auth::attempt($validator->validated())) {
            $request->session()->regenerate();
            return [
                'status' => true,
            ];
        };

        return [
            'status' => false,
            'errors' => [
                'account' => [
                    'Wrong user name or password'
                ]
            ]
        ];
    }

    public function register(mixed $request): array
    {
        return [];
    }
}

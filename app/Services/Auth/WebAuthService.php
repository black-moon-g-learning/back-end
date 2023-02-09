<?php

namespace App\Services\Auth;

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

        return [
            'status' => true,
        ];
    }

    public function register(mixed $request): array
    {
        return [];
    }
}

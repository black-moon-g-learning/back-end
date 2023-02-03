<?php

namespace App\Services\Auth;

interface IAuthService
{
    public function login(mixed $request): array;
    public function register(mixed $request): array;
}

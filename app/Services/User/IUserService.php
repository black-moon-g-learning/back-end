<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;


interface IUserService
{
    public function index();

    public function delete(int $id): array;

    public function update(UserRequest $request): array;
}

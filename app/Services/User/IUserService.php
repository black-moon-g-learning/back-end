<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface IUserService
{
    public function index();

    public function delete(int $id): array;

    public function update(UserRequest $request): array;

    public function updateStatus(int $id, Request $request);
}

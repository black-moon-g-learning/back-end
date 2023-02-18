<?php

namespace App\Services\User;

interface IUserService
{
    public function index();

    public function delete(int $id): array;
}

<?php

namespace App\Services\User;

use App\Repositories\User\IUserRepository;

class UserService implements IUserService
{
    protected IUserRepository $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return $this->userRepo->getDataWithPaginate();
    }
}

<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function getProfile(int $userId)
    {
        return $this->model->find($userId)->first();
    }
}

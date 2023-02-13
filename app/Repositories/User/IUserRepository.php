<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\RepositoryInterface;

interface IUserRepository extends RepositoryInterface
{
    public function getProfile(int $userId);

    public function findByFirebaseUid(string $uid): mixed;
}

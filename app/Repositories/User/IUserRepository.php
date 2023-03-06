<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface IUserRepository extends RepositoryInterface
{
    public function getProfile(int $userId);

    public function findByFirebaseUid(string $uid): mixed;

    public function getUserWithoutAdmin(int $limit = 20): mixed;

    public function countUsers();

    public function getUserRegisterInYear(int $year);
}

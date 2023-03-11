<?php

namespace App\Repositories\User;

use App\Constants\Process;
use App\Constants\Role;
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

    public function findByFirebaseUid(string $uid): mixed
    {
        return $this
            ->model
            ->where('firebase_uid', $uid)
            ->first();
    }
    public function getUserWithoutAdmin(int $limit = 20): mixed
    {
        return $this
            ->model
            ->with(['payment' => function ($query) {
                return $query->where('process', Process::SUCCESS);
            }])
            // ->where('role_id', '!=', Role::ADMIN_ROLE)
            ->paginate($limit);
    }

    public function countUsers()
    {
        return $this->model->where('role_id', '!=', Role::ADMIN_ROLE)->count();
    }

    public function getUserRegisterInYear(int $year)
    {
        return $this
            ->model
            ->selectRaw('MONTH(created_at) AS month, COUNT(*) AS user')
            ->whereRaw('YEAR(created_at) = ' . $year . '')
            ->groupByRaw('MONTH(created_at)')
            ->where('role_id', '!=', Role::ADMIN_ROLE)
            ->get();
    }

    public function getUserTokenDevice()
    {
        return $this
            ->model
            // ->where('role_id', '!=', Role::ADMIN_ROLE)
            ->whereNotNull('device_token')
            ->pluck('device_token')
            ->all();
    }
}

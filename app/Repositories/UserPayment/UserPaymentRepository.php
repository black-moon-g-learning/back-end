<?php

namespace App\Repositories\UserPayment;

use App\Models\UserPayment;
use App\Repositories\BaseRepository;

class UserPaymentRepository extends BaseRepository implements IUserPaymentRepository
{
    public function getModel()
    {
        return UserPayment::class;
    }

    public function index()
    {
        return $this->model->with(['user', 'service'])->get();
    }
}

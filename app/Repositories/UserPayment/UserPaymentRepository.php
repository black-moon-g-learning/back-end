<?php

namespace App\Repositories\UserPayment;

use App\Constants\Process;
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

    public function findPaymentByOrderId(string $orderId)
    {
        return $this
            ->model
            ->where('order_id', $orderId)
            ->first();
    }

    public function getUserPaySuccessful()
    {
        return $this
            ->model
            ->where('process', Process::SUCCESS)
            ->count();
    }
}

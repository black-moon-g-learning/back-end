<?php

namespace App\Repositories\UserPayment;

use App\Repositories\RepositoryInterface;

interface IUserPaymentRepository extends RepositoryInterface
{
    public function index();

    public function findPaymentByOrderId(string $orderId);

    public function getUserPaySuccessful();
}

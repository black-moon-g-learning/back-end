<?php

namespace App\Repositories\UserPayment;

use App\Repositories\RepositoryInterface;

interface IUserPaymentRepository extends RepositoryInterface
{
    public function index();
}

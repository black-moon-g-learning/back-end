<?php

namespace App\Services\UserPayment;

interface IUserPaymentService
{
    public function create(string $orderId, int $userId, int $serviceId): bool;
}

<?php

namespace App\Services\UserPayment;

interface IUserPaymentService
{
    public function create(string $orderId, int $userId, int $serviceId): bool;

    public function findPaymentByOrderId(string $orderId);

    public function updateStatus(string $status, int $id);
}

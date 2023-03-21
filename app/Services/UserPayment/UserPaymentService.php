<?php

namespace App\Services\UserPayment;

use App\Constants\Payment;
use App\Constants\Process;
use App\Repositories\Package\IPackageRepository;
use App\Repositories\UserPayment\IUserPaymentRepository;
use Illuminate\Http\Request;

class UserPaymentService implements IUserPaymentService
{
    protected IUserPaymentRepository $userPayment;

    public function __construct(
        IUserPaymentRepository $userPayment,
    ) {
        $this->userPayment = $userPayment;
    }

    public function create(string $orderId, int $userId, int $serviceId): bool
    {

        $userPayment = array();
        $userPayment['process'] = Process::DOING;
        $userPayment['user_id'] = $userId;
        $userPayment['payment'] = Payment::NAME;
        $userPayment['service_id'] = $serviceId;
        $userPayment['order_id'] = $orderId;

        $userPaymentCreated =  $this->userPayment->create($userPayment);
        if ($userPaymentCreated) {
            return true;
        }
        return false;
    }

    public function findPaymentByOrderId(string $orderId)
    {
        return $this->userPayment->findPaymentByOrderId($orderId);
    }

    public function updateStatus(string $status, int $id)
    {
        $userPayment = array();
        $userPayment['process'] = $status;

        return $this->userPayment->update($id, $userPayment);
    }
}

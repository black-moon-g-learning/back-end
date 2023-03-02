<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Payment\IPaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected IPaymentService $paymentSer;

    public function __construct(IPaymentService $paymentSer)
    {
        $this->paymentSer = $paymentSer;
    }

    public function getUrlPayment(Request $request)
    {
        $paymentUrl = $this->paymentSer->getUrl($request);
        return $this->responseSuccessWithData(['url' => $paymentUrl]);
    }
}

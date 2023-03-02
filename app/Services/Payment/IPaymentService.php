<?php

namespace App\Services\Payment;

use Illuminate\Http\Request;

interface IPaymentService
{
    public function getUrl(Request $request): string;

    public function checkIsPayMentSuccess(Request $request);
}

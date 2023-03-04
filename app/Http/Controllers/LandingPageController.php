<?php

namespace App\Http\Controllers;

use App\Services\Payment\IPaymentService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    protected IPaymentService $paymentSer;

    public function __construct(IPaymentService $paymentSer)
    {
        $this->paymentSer = $paymentSer;
    }

    public function showLandingPage()
    {
        return view('pages.landing');
    }

    public function returnPayment(Request $request)
    {
        $response = $this->paymentSer->returnPayment($request);
        return view('pages.return-payment', compact('response'));
    }
}

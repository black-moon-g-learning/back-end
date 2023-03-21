<?php

namespace App\Http\Controllers;

use App\Repositories\Package\IPackageRepository;
use App\Services\Payment\IPaymentService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    protected IPaymentService $paymentSer;
    protected IPackageRepository $packageRepo;

    public function __construct(
        IPaymentService $paymentSer,
        IPackageRepository $packageRepo
    ) {
        $this->paymentSer = $paymentSer;
        $this->packageRepo = $packageRepo;
    }

    public function showLandingPage()
    {
        $package =  $this->packageRepo->first();
        return view('pages.landing', compact('package'));
    }

    public function returnPayment(Request $request)
    {
        $response = $this->paymentSer->returnPayment($request);
        return view('pages.return-payment', compact('response'));
    }
}

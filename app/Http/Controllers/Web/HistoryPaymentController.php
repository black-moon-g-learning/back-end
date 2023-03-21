<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\UserPayment\IUserPaymentRepository;
use Illuminate\Http\Request;

class HistoryPaymentController extends Controller
{
    protected IUserPaymentRepository $userPaymentRepo;

    public function __construct(IUserPaymentRepository $userPaymentRepo)
    {
        $this->userPaymentRepo = $userPaymentRepo;
    }

    public function index()
    {
        $userPayments = $this->userPaymentRepo->index();
        return view('pages.user-payment', compact('userPayments'));
    }
}

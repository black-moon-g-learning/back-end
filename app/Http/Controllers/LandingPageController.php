<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function showLandingPage()
    {
        return view('pages.landing');
    }

    public function returnPayment()
    {
        return view('pages.return-payment');
    }
}

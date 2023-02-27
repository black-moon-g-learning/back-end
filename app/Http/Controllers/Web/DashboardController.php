<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\IDashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected IDashboardService $dashboardSer;

    public function __construct(IDashboardService $dashboardSer)
    {
        $this->dashboardSer = $dashboardSer;
    }
    public function dashboard()
    {
        return view('pages.dashboard');
    }
}

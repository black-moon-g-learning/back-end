<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Package\IPackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected IPackageService $packageSer;

    public function __construct(IPackageService $packageSer)
    {
        $this->packageSer = $packageSer;
    }

    public function index()
    {
        $services = $this->packageSer->indexAdmin();
        return view('pages.services', compact('services'));
    }
}

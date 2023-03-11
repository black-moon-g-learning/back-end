<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Package\IPackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PackageController extends Controller
{
    protected IPackageService $packageSer;

    public function __construct(IPackageService $packageSer)
    {
        $this->packageSer = $packageSer;
    }

    public function index()
    {
        $response = $this->packageSer->index();
        return $this->responseSuccessWithData($response);
    }
}

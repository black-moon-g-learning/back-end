<?php

namespace App\Services\Package;

use App\Http\Resources\ServiceResource;
use App\Repositories\Package\IPackageRepository;

class PackageService implements IPackageService
{
    protected IPackageRepository $packageRepo;

    public function __construct(IPackageRepository $packageRepo)
    {
        $this->packageRepo = $packageRepo;
    }

    public function getAllData()
    {
        return $this->packageRepo->getAll();
    }

    public function index()
    {
        $response = $this->getAllData();
        return collect(ServiceResource::collection($response))->toArray();
    }

    public function indexAdmin()
    {
        return $this->getAllData();
    }
}

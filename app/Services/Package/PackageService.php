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

    public function index()
    {
        $response = $this->packageRepo->getAll();
        return collect(ServiceResource::collection($response))->toArray();
    }
}

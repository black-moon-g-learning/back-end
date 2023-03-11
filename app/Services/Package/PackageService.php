<?php

namespace App\Services\Package;

use App\Http\Resources\ServiceResource;
use App\Repositories\Package\IPackageRepository;
use App\Services\Validate\PackageValidateService;
use Illuminate\Http\Request;

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

    public function edit(int $id)
    {
        return $this->packageRepo->find($id);
    }

    public function update(Request $request, int $id)
    {
        $validator = new PackageValidateService($request->all());
        $validated = $validator->afterValidated();

        if ($validated['status']) {
            $package = $validated['data'];
            $this->packageRepo->update($id, $package);

            return [
                'status' => true,
                'data' => "Update package successful"
            ];
        }

        return $validated;
    }
}

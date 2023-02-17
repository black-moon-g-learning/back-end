<?php

namespace App\Repositories\Package;

use App\Models\Service;
use App\Repositories\BaseRepository;

class PackageRepository extends BaseRepository implements IPackageRepository
{
    public function getModel()
    {
        return Service::class;
    }
}

<?php

namespace App\Repositories\Package;

use App\Repositories\RepositoryInterface;

interface IPackageRepository extends RepositoryInterface
{
    public function getFirstRow();
}
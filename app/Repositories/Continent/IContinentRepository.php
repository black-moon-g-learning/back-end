<?php

namespace App\Repositories\Continent;

use App\Repositories\RepositoryInterface;

interface IContinentRepository extends RepositoryInterface
{
    public function getCountries(int $continentId);
}

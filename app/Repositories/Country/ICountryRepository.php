<?php

namespace App\Repositories\Country;

use App\Repositories\RepositoryInterface;

interface ICountryRepository extends RepositoryInterface
{
    public function getCountries(int $continentId);
}

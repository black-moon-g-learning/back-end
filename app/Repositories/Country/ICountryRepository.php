<?php

namespace App\Repositories\Country;

use App\Repositories\RepositoryInterface;

interface ICountryRepository extends RepositoryInterface
{
    public function getCountries(int $limit = 10);

    public function getAttributeCountries(array $attribute, int $limit = 10);
}

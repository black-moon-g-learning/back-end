<?php

namespace App\Repositories\Country;

use App\Repositories\RepositoryInterface;

interface ICountryRepository extends RepositoryInterface
{
    public function getCountries(int $userId, int $limit = 10);

    public function getAttributeCountries(array $attribute, int $limit = 10);

    public function getCountriesInContinent(int $continentId, int $limit = 10);

    public function searchCountries(int $continentId, string $textSearch);
}

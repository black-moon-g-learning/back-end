<?php

namespace App\Repositories\Country;

use App\Constants\Common;
use App\Repositories\RepositoryInterface;

interface ICountryRepository extends RepositoryInterface
{
    public function getCountries(int $userId, int $limit = 10);

    public function getAttributeCountries(array $attribute, int $limit = 10);

    public function getCountriesInContinent(int $continentId, int $limit = 10);

    public function getAllCountries(int $limit);

    public function searchCountries(int $continentId = Common::CONTINENT_ID_NULL, string $textSearch);
}

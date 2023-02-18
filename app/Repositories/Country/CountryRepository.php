<?php

namespace App\Repositories\Country;

use App\Models\Country;
use App\Repositories\BaseRepository;

class CountryRepository extends BaseRepository implements ICountryRepository
{
    public function getModel()
    {
        return Country::class;
    }

    public function getCountries(int $limit = 10)
    {
        return $this->model->paginate($limit);
    }

    public function getAttributeCountries(array $attribute, int $limit = 10)
    {
        return $this->model->paginate($limit, $attribute);
    }

    public function getCountriesInContinent(int $continentId, int $limit = 10)
    {
        return $this
            ->model
            ->where('continent_id', $continentId)
            ->paginate($limit);
    }
}

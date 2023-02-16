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
}

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

    public function getCountries(int $userId, int $limit = 10)
    {
        return $this->model->with(['usersPlayGame' => function ($query) use ($userId) {
            $query->where('owner_id', $userId);
        }])->paginate($limit);
    }

    public function getAttributeCountries(array $attribute, int $limit = 10)
    {
        return $this->model
            ->paginate($limit, $attribute)
            ->appends(['attribute' => $attribute[1]]);
    }

    public function getCountriesInContinent(int $continentId, int $limit = 10)
    {
        return $this
            ->model
            ->where('continent_id', $continentId)
            ->paginate($limit);
    }
}

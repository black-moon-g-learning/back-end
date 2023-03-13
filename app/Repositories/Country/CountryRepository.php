<?php

namespace App\Repositories\Country;

use App\Constants\Common;
use App\Models\Country;
use App\Repositories\BaseRepository;

class CountryRepository extends BaseRepository implements ICountryRepository
{
    public function getModel()
    {
        return Country::class;
    }

    public function getCountries(int $userId, int $limit = 20)
    {
        return $this->model->with(['usersPlayGame' => function ($query) use ($userId) {
            $query->where('owner_id', $userId);
        }])->paginate($limit);
    }

    public function getAttributeCountries(array $attribute, int $limit = 20)
    {
        return $this->model
            ->paginate($limit, $attribute)
            ->appends(['attribute' => $attribute[1]]);
    }

    public function getCountriesInContinent(int $continentId, int $limit = 20)
    {
        return $this
            ->model
            ->where('continent_id', $continentId)
            ->paginate($limit);
    }

    public function getAllCountries(int $limit)
    {
        return $this->model->paginate($limit);
    }

    public function searchCountries(int $continentId = Common::CONTINENT_ID_NULL, string $textSearch)
    {
        $query = $this->model->search($textSearch);

        if (!($continentId === Common::CONTINENT_ID_NULL)) {
            $query->where('continent_id', $continentId);
        }

        return $query->get();
    }
}

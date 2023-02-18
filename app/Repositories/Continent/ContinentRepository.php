<?php

namespace App\Repositories\Continent;

use App\Http\Resources\CountryResource;
use App\Models\Continent;
use App\Repositories\BaseRepository;

class ContinentRepository extends BaseRepository implements IContinentRepository
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Continent::class;
    }

    public function getCountries(int $id)
    {
        $continent = $this->model->find($id);
        $countries = $continent->countries->toArray();

        usort($countries, function ($first, $second) {
            return $first['place']  > $second['place'];
        });

        $popularCountries = array_slice($countries, 0, 5);
        $otherCountries = array_slice($countries, 5);

        $response['popular'] = collect(
            CountryResource::collection(collect($popularCountries))
        )->toArray();

        $response['countries'] = collect(
            CountryResource::collection(collect($otherCountries))
        )->toArray();;

        return $response;
    }

    public function getAll()
    {
        return $this->model->withCount('countries')->get();
    }
}

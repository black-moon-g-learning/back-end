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
        $countries = $continent->countries;

        $popularCountries = [];
        $otherCountries = [];
        $response = [];

        foreach ($countries as $country) {

            $rank = $country->place ?? 0;

            if ($rank > 5) {
                array_push($popularCountries, $country);
            } else {
                array_push($otherCountries, $country);
            }
        }

        $response['popular'] = collect(CountryResource::collection($popularCountries))->toArray();
        $response['countries'] = collect(CountryResource::collection($otherCountries))->toArray();

        return $response;
    }
}

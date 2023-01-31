<?php

namespace App\Repositories\Continent;

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
        return  $countries;
    }
}

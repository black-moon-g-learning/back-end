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

    
}

<?php

namespace App\Repositories\CountryTopic;

use App\Models\CountryTopic;
use App\Repositories\BaseRepository;

class CountryTopicRepository extends BaseRepository implements ICountryTopicRepository
{
    public function getModel()
    {
        return CountryTopic::class;
    }
    public function getAllWithVideos(int $countryID)
    {
        return $this->model->where('country_id', $countryID)->with('topic')->withCount('videos')->paginate(20);
    }
}

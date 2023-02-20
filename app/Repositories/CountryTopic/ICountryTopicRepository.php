<?php

namespace App\Repositories\CountryTopic;

use App\Repositories\RepositoryInterface;

interface ICountryTopicRepository extends RepositoryInterface
{
    public function getAllWithVideos(int $countryID);
}

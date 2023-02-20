<?php

namespace App\Services\CountryTopic;

use App\Repositories\Country\ICountryRepository;
use App\Repositories\CountryTopic\ICountryTopicRepository;
use App\Repositories\Topic\ITopicRepository;

class CountryTopicService implements ICountryTopicService
{
    protected ICountryRepository $countryRepo;

    protected ICountryTopicRepository $countryTopicRepo;


    public function __construct(
        ICountryRepository $countryRepo,
        ICountryTopicRepository $countryTopicRepo
    ) {
        $this->countryRepo = $countryRepo;
        $this->countryTopicRepo = $countryTopicRepo;
    }

    public function index(int $countryId)
    {
        $result['country'] = $this->countryRepo->find($countryId);
        $result['topics'] = $this->countryTopicRepo->getAllWithVideos($countryId);

        return $result;
    }
}

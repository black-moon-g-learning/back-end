<?php

namespace App\Services\CountryTopic;

use App\Repositories\Country\ICountryRepository;
use App\Repositories\Topic\ITopicRepository;

class CountryTopicService implements ICountryTopicService
{
    protected ITopicRepository $topicRepo;
    protected ICountryRepository $countryRepo;

    public function __construct(
        ITopicRepository $topicRepo,
        ICountryRepository $countryRepo
    ) {
        $this->topicRepo = $topicRepo;
        $this->countryRepo = $countryRepo;
    }

    public function index(int $countryId)
    {
        $result['country'] = $this->countryRepo->find($countryId);
        $result['topics'] = $this->topicRepo->getTopicsInCountry($countryId);

        return $result;
    }
}

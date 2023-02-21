<?php

namespace App\Services\CountryTopic;

use App\Repositories\Country\ICountryRepository;
use App\Repositories\CountryTopic\ICountryTopicRepository;
use App\Repositories\Topic\ITopicRepository;
use Illuminate\Http\Request;

class CountryTopicService implements ICountryTopicService
{
    protected ICountryRepository $countryRepo;
    protected ICountryTopicRepository $countryTopicRepo;
    protected ITopicRepository $topicRepo;


    public function __construct(
        ICountryRepository $countryRepo,
        ICountryTopicRepository $countryTopicRepo,
        ITopicRepository $topicRepo
    ) {
        $this->countryRepo = $countryRepo;
        $this->countryTopicRepo = $countryTopicRepo;
        $this->topicRepo = $topicRepo;
    }

    public function index(int $countryId)
    {
        $result['country'] = $this->countryRepo->find($countryId);
        $result['topics'] = $this->countryTopicRepo->getAllWithVideos($countryId);
        $topicSelected = $result['topics']->pluck('topic_id');
        $result['remainTopics'] = $this->topicRepo->getTopicsNotInWhere($topicSelected->toArray());

        return $result;
    }

    public function storeTopic(Request $request, int $countryId)
    {
        $attribute['country_id'] = $countryId;
        $attribute['topic_id'] = $request->get('topic_id');

        $countryTopic =  $this->countryTopicRepo->create($attribute);

        if ($countryTopic) {

            return [
                'status' => true,
                'data' => 'Create new topic successful'
            ];
        } else {

            return [
                'status' => false,
                'data' => 'Somethings is wrong, can not update now'
            ];
        }
    }
}

<?php

namespace App\Repositories\Topic;

use App\Models\Topic;
use App\Repositories\BaseRepository;

class TopicRepository extends BaseRepository implements ITopicRepository
{
    public function getModel()
    {
        return Topic::class;
    }

    public function getTopics(?int $countryId)
    {

        return $this->model
            ->join('countries_topics', 'topic_id', 'topics.id')
            ->where('countries_topics.country_id', $countryId)
            ->get();
    }
}

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

        return $this->query($countryId)->get();
    }

    public function query($countryId)
    {
        return $this->model
            ->join('countries_topics', 'topic_id', 'topics.id')
            ->where('countries_topics.country_id', $countryId);
    }

    public function getAllWithCountVideos()
    {
        return $this->model->withCount('videos')->paginate();
    }

    public function editWithCountVideo(int $id)
    {
        return $this->model->withCount('videos')->find($id);
    }

    public function getTopicsNotInWhere(array $topicIds)
    {
        return $this->model->whereNotIn('id', $topicIds)->paginate(20);
    }
}

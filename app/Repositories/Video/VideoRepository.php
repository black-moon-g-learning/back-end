<?php

namespace App\Repositories\Video;

use App\Models\Video;
use App\Repositories\BaseRepository;

class VideoRepository extends BaseRepository implements IVideoRepository
{
    public function getModel()
    {
        return Video::class;
    }

    public function getVideos(int $countryTopicId)
    {
        return $this
            ->model
            ->where('country_topic_id', '=', $countryTopicId)
            ->get();
    }
}

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

    public function getVideos(int $countryTopicId, int $userId)
    {
        return $this
            ->model
            ->where('country_topic_id', '=', $countryTopicId)
            ->with(['user', 'watched' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->latest('videos.id')
            ->get();
    }

    public function search(int $countryTopicId, string $search)
    {
        return $this
            ->model
            ->search($search)
            ->where('country_topic_id', '=', $countryTopicId)
            ->get();
    }

    public function getWatchedVideos(int $userId)
    {
        return $this->model
            ->join('watched', 'watched.video_id', '=', 'videos.id')
            ->where('watched.user_id', $userId)
            ->with(['user', 'watched'])
            ->latest('watched.created_at')
            ->get(['videos.*']);
    }

    public function countVideos()
    {
        return $this->model->count();
    }

    public function getVideosAdmin(int $countryTopicId)
    {
        return $this
            ->model
            ->where('country_topic_id', '=', $countryTopicId)
            ->with(['user'])
            ->get();
    }
}

<?php

namespace App\Repositories\Watched;

use App\Models\Watched;
use App\Repositories\BaseRepository;

class WatchRepository extends BaseRepository implements IWatchedRepository
{
    public function getModel()
    {
        return Watched::class;
    }

    public function findWatchedVideo(int $userId, int $videoId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('video_id', $videoId)
            ->first();
    }

    public function getWatchedVideos(int $userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->with('video')
            ->get();
    }
}

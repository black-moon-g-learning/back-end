<?php

namespace App\Repositories\Watched;

use App\Repositories\RepositoryInterface;

interface IWatchedRepository extends RepositoryInterface
{
    public function findWatchedVideo(int $userId, int $videoId);
}

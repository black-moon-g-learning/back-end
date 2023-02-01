<?php

namespace App\Repositories\Video;

use App\Repositories\RepositoryInterface;

interface IVideoRepository extends RepositoryInterface
{
    public function getVideos(int $countryTopicId);
}

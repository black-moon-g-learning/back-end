<?php

namespace App\Repositories\Video;

use App\Repositories\RepositoryInterface;

interface IVideoRepository extends RepositoryInterface
{
    public function getVideos(int $countryTopicId);

    public function search(int $countryTopicId, string $search);
}

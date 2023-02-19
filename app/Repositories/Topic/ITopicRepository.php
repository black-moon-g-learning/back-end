<?php

namespace App\Repositories\Topic;

use App\Repositories\RepositoryInterface;

interface ITopicRepository extends RepositoryInterface
{
    public function getTopics(?int $countryId);

    public function getAllWithCountVideos();
}

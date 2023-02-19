<?php

namespace App\Services\Topic;

use App\Repositories\Topic\ITopicRepository;

class TopicService implements ITopicService
{

    protected ITopicRepository $topicRepo;

    public function __construct(ITopicRepository $topicRepo)
    {
        $this->topicRepo = $topicRepo;
    }

    public function index()
    {
        return $this->topicRepo->getAllWithCountVideos(20);
    }
}

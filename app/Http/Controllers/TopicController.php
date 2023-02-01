<?php

namespace App\Http\Controllers;

use App\Repositories\Topic\ITopicRepository;
use Illuminate\Http\Request;


class TopicController extends Controller
{

    protected $topicRepo;

    public function __construct(ITopicRepository $topicRepo)
    {
        $this->topicRepo = $topicRepo;
    }

    public function index(?int $countryId)
    {
        return $this->topicRepo->getTopics($countryId);
    }
}

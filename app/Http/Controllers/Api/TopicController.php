<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TopicResource;
use App\Http\Controllers\Controller;
use App\Repositories\Topic\ITopicRepository;
use App\Utils\Response;
use Illuminate\Http\Request;


class TopicController extends Controller
{

    use Response;

    protected $topicRepo;

    public function __construct(ITopicRepository $topicRepo)
    {
        $this->topicRepo = $topicRepo;
    }

    public function index(?int $countryId)
    {
        $response = collect(
            TopicResource::collection(
                $this->topicRepo->getTopics($countryId)
            )
        );

        return $this->responseSuccessWithData($response->toArray());
    }
}

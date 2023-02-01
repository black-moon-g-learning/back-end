<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Repositories\Video\IVideoRepository;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected $videoRepo;

    public function __construct(IVideoRepository $videoRepo)
    {
        $this->videoRepo = $videoRepo;
    }

    public function index(int $countryTopicId)
    {
        $response = collect(VideoResource::collection($this->videoRepo->getVideos($countryTopicId)))->toArray();
        return $response;
    }
}

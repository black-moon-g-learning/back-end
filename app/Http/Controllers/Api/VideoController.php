<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\VideoResource;
use App\Http\Controllers\Controller;
use App\Repositories\Video\IVideoRepository;
use App\Utils\Response;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use Response;

    protected $videoRepo;

    public function __construct(IVideoRepository $videoRepo)
    {
        $this->videoRepo = $videoRepo;
    }

    public function index(int $countryTopicId)
    {
        $response = collect(
            VideoResource::collection(
                $this->videoRepo->getVideos($countryTopicId)
            )
        )->toArray();

        return $this->responseSuccessWithData($response);
    }
}

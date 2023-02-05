<?php

namespace App\Services\Video;

use App\Http\Resources\VideoResource;
use App\Repositories\Video\IVideoRepository;

class VideoService implements IVideoService
{
    protected IVideoRepository  $videoRepo;

    public function __construct(IVideoRepository $videoRepo)
    {
        $this->videoRepo = $videoRepo;
    }

    public function search(int $countryTopicId, string $search)
    {
        $response = collect(
            VideoResource::collection(
                $this->videoRepo->search($countryTopicId, $search)
            )
        )->toArray();
        return $response;
    }

    public function index(int $countryTopicId)
    {
        $response = collect(
            VideoResource::collection(
                $this->videoRepo->getVideos($countryTopicId)
            )
        )->toArray();

        return $response;
    }
}

<?php

namespace App\Services\Video;

use App\Http\Resources\VideoResource;
use App\Http\Resources\VideoSearchResource;
use App\Repositories\Video\IVideoRepository;

class VideoService implements IVideoService
{
    protected IVideoRepository  $videoRepo;

    /**
     * __construct
     *
     * @param  IVideoRepository $videoRepo
     * @return void
     */
    public function __construct(IVideoRepository $videoRepo)
    {
        $this->videoRepo = $videoRepo;
    }

    /**
     * search
     *
     * @param  int $countryTopicId
     * @param  mixed $search
     * @return void
     */
    public function search(int $countryTopicId, string $search)
    {
        $data = $this->videoRepo->search($countryTopicId, $search);

        return $this->formatResponse('videoSearch', $data);
    }

    /**
     * index
     *
     * @param  mixed $countryTopicId
     * @return void
     */
    public function index(int $countryTopicId)
    {
        $data = $this->videoRepo->getVideos($countryTopicId);

        return $this->formatResponse('video', $data);
    }

    /**
     * formatResponse
     *
     * @param  mixed $type
     * @param  mixed $data
     * @return array
     */
    public function formatResponse(string $type, mixed $data): array
    {
        switch ($type) {
            case 'video':
                return collect(
                    VideoResource::collection(
                        $data
                    )
                )->toArray();
            case 'videoSearch':
                return collect(
                    VideoSearchResource::collection(
                        $data
                    )
                )->toArray();
            default:
                return [];
        }
    }
}

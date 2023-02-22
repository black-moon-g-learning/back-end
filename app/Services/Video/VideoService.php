<?php

namespace App\Services\Video;

use App\Http\Resources\VideoResource;
use App\Http\Resources\VideoSearchResource;
use App\Repositories\Video\IVideoRepository;
use App\Services\Storage\IStorageService;
use App\Services\Validate\VideoValidateService;
use Illuminate\Http\Request;

class VideoService implements IVideoService
{
    protected IVideoRepository  $videoRepo;

    protected IStorageService $storeSer;

    /**
     * __construct
     *
     * @param  IVideoRepository $videoRepo
     * @return void
     */
    public function __construct(
        IVideoRepository $videoRepo,
        IStorageService $storeSer
    ) {
        $this->videoRepo = $videoRepo;
        $this->storeSer = $storeSer;
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
    public function indexWeb(int $countryTopicId): mixed
    {
        return $this->videoRepo->getVideos($countryTopicId);
    }

    public function find(int $videoId): mixed
    {
        return $this->videoRepo->find($videoId);
    }

    public function update(Request $request, int $videoId): array
    {
        $validator = new VideoValidateService($request->all());
        $validated = $validator->afterValidated();
        if ($validated['status']) {

            $video = $validated['data'];
            $videoDB = $this->videoRepo->find($videoId);

            if ($validator->getHasFile()) {

                if ($this->storeSer->exists($videoDB->image)) {
                    $this->storeSer->delete($videoDB->image);
                }

                $file = $request->file('file');
                $uploaded = $this->storeSer->upload($file, 'videos');

                if ($uploaded['status']) {
                    $video['image'] = $uploaded['url'];
                }
            }
            $this->videoRepo->update($videoId, $video);

            return [
                'status' => true,
                'data' => "Update Video successful"
            ];
        }
        return $validated;
    }
}

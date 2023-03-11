<?php

namespace App\Services\Video;

use App\Http\Resources\VideoResource;
use App\Http\Resources\VideoSearchResource;
use App\Repositories\Video\IVideoRepository;
use App\Services\Storage\IStorageService;
use App\Services\Validate\VideoValidateService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

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
        $user = Auth::user();
        $data = $this->videoRepo->getVideos($countryTopicId, $user->id);

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
        return $this->videoRepo->getVideosAdmin($countryTopicId);
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

    public function store(Request $request): array
    {
        $validator = new VideoValidateService($request->all());
        $validated = $validator->afterValidated();
        $owner =  Auth::user();


        if ($validated['status']) {
            $video = $validated['data'];

            if ($validator->getHasFile()) {
                $video['image'] =  $this->uploadFile($request->file('file'));
            }
            $video['url'] = $video['video_url'];
            $video['owner_id'] = $owner->id;

            $this->videoRepo->create($video);

            return [
                'status' => true,
                'data' => "Create new Video successful"
            ];
        }
        return  $validated;
    }

    public function uploadFile(UploadedFile $file)
    {
        $uploaded = $this->storeSer->upload($file, 'videos');

        if ($uploaded['status']) {
            return $uploaded['url'];
        }
        return null;
    }

    public function uploadVideo(Request $request): array
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $uploaded = $this->storeSer->uploadLargeFile($file, $fileName);

            return $uploaded;
        }
        return [
            'status' => false,
            'path' =>  null,
        ];
    }
}

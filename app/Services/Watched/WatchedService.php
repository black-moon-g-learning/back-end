<?php

namespace App\Services\Watched;

use App\Http\Resources\VideoHistoryResource;
use App\Http\Resources\VideoResource;
use App\Models\User;
use App\Repositories\Video\IVideoRepository;
use App\Repositories\Watched\IWatchedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchedService implements IWatchedService
{
    protected IWatchedRepository $watchedRepo;

    protected IVideoRepository $videoRepo;


    public function __construct(
        IWatchedRepository $watchedRepo,
        IVideoRepository $videoRepo
    ) {
        $this->watchedRepo = $watchedRepo;
        $this->videoRepo = $videoRepo;
    }

    public function storeUserWatched(Request $request, int $videoId)
    {
        $user = Auth::user();
        $watched = $this->watchedRepo->findWatchedVideo($user->id, $videoId);

        $data['user_id'] = $user->id;
        $data['video_id'] = $videoId;
        $data['stop_at'] =  $request->get('stop-at');

        if ($watched) {
            $this->watchedRepo->update($watched->id, $data);
        } else {
            $this->watchedRepo->create($data);
        }
    }

    public function getWatchedVideos()
    {
        $user = Auth::user();
        return collect(VideoResource::collection($this->videoRepo->getWatchedVideos($user->id)))->toArray();
    }
}

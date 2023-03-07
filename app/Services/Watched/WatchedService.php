<?php

namespace App\Services\Watched;

use App\Models\User;
use App\Repositories\Watched\IWatchedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchedService implements IWatchedService
{
    protected IWatchedRepository $watchedRepo;


    public function __construct(IWatchedRepository $watchedRepo)
    {
        $this->watchedRepo = $watchedRepo;
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
        return $this->watchedRepo->getWatchedVideos($user->id);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\History\IHistoryService;
use App\Services\Watched\IWatchedService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    protected IHistoryService $historySer;

    protected IWatchedService $watchedSer;

    public function __construct(
        IHistoryService $historySer,
        IWatchedService $watchedSer
    ) {
        $this->historySer = $historySer;
        $this->watchedSer = $watchedSer;
    }

    public function storeUserPlayGame(Request $request, int $countryId)
    {
        $this->historySer->storeUserPlayGame($request, $countryId);
        return $this->responseSuccess(201);
    }

    public function storeUserWatched(Request $request, int $videoId)
    {
        $this->watchedSer->storeUserWatched($request, $videoId);
        return $this->responseSuccess(201);
    }

    public function getWatchedVideos()
    {
        $watchedVideo = $this->watchedSer->getWatchedVideos();
        return $this->responseSuccessWithData($watchedVideo);
    }
}

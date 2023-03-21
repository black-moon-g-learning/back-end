<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Video\IVideoService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected IVideoService $videoService;

    public function __construct(IVideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index(int $countryTopicId, Request $request)
    {
        if ($request->has('s')) {

            $search = $request->input('s');
            $response =  $this->videoService->search($countryTopicId, $search);

            return $this->responseSuccessWithData($response);
        }

        $response = $this->videoService->index($countryTopicId);

        return $this->responseSuccessWithData($response);
    }
}

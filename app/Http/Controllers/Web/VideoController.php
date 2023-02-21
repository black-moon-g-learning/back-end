<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Video\IVideoService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected IVideoService $videoSer;

    public function __construct(IVideoService $videoSer)
    {
        $this->videoSer = $videoSer;
    }

    public function index(int $countryTopicId)
    {
        $videos =  $this->videoSer->indexWeb($countryTopicId);
        return view('pages.videos', compact('videos'));
    }
}

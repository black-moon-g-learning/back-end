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
        return view('pages.videos', compact('videos', 'countryTopicId'));
    }

    public function edit(int $videoId)
    {
        $video = $this->videoSer->find($videoId);
        return view('forms.video', compact('video'));
    }

    public function update(Request $request, int $videoId)
    {
        $response = $this->videoSer->update($request, $videoId);

        if ($response['status']) {
            return redirect()->route('web.countries-topics.videos', $request->get('country_topic_id'))->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }

    public function create(Request $request)
    {
        $countryTopicId = $request->query('ct-id');
        return view('forms.video', compact('countryTopicId'));
    }

    public function store(Request $request)
    {
        $response = $this->videoSer->store($request);

        if ($response['status']) {
            return redirect()->route('web.countries-topics.videos', $request->get('country_topic_id'))->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }

    public function uploadVideo(Request $request)
    {
        return $this->videoSer->uploadVideo($request);
    }
}

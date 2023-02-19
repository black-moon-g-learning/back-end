<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Topic\ITopicService;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected ITopicService $topicSer;

    public function __construct(ITopicService $topicSer)
    {
        $this->topicSer = $topicSer;
    }

    public function index()
    {
        $topics = $this->topicSer->index();
        return view('pages.topics', compact('topics'));
    }
}

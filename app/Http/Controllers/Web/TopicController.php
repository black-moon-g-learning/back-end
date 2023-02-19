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

    public function edit(int $id)
    {
        $topic = $this->topicSer->edit($id);
        return view('forms.topic', compact('topic'));
    }

    public function update(Request $request, int $id)
    {
        $response = $this->topicSer->update($request, $id);

        if ($response['status']) {
            return redirect()->route('web.topics')->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }

    public function delete(int $id)
    {
        $response = $this->topicSer->delete($id);
        return redirect()->route('web.topics')->with('response', $response);
    }

    public function create()
    {
        return view('forms.topic');
    }

    public function store(Request $request)
    {
        $response = $this->topicSer->store($request);
        
        if ($response['status']) {
            return redirect()->route('web.topics')->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }
}

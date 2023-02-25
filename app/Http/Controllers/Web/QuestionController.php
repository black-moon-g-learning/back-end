<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Question\IQuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected IQuestionService $questionSer;

    public function __construct(IQuestionService $questionSer)
    {
        $this->questionSer = $questionSer;
    }

    public function index(int $countryId)
    {
        $questions = $this->questionSer->indexAdmin($countryId);
        return view('pages.questions', compact('questions', 'countryId'));
    }

    public function update(Request $request, int $id)
    {
        $response =  $this->questionSer->update($request, $id);
        if ($response['status']) {
            if ($response['countryId']) {
                return redirect()->route('web.questions', $response['countryId'])->with('response', $response);
            }
            return redirect()->route('web.continents')->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }

    public function edit(int $id)
    {
        $question = $this->questionSer->edit($id);
        return view('forms.question', compact('question'));
    }

    public function create(Request $request)
    {
        $countryId = $request->get('country-id');
        return view('forms.question', compact('countryId'));
    }

    public function store(Request $request)
    {
        $response = $this->questionSer->store($request);
        if ($response['status']) {
            if ($response['countryId']) {
                return redirect()->route('web.questions', $response['countryId'])->with('response', $response);
            }
            return redirect()->route('web.continents')->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }
}

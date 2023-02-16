<?php

namespace App\Http\Controllers\Api;

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

    public function index(int $videoId)
    {
        $response = $this->questionSer->getAllQuestionInVideo($videoId);
        return $this->responseSuccessWithData($response->toArray());;
    }
}

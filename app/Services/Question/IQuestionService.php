<?php

namespace App\Services\Question;

use Illuminate\Support\Collection;

interface IQuestionService 
{
    public function getAllQuestionInVideo(int $videoId):Collection;
}
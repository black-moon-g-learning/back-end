<?php

namespace App\Repositories\Answer;

use App\Constants\Common;
use App\Models\Answer;
use App\Repositories\BaseRepository;

class AnswerRepository extends BaseRepository implements IAnswerRepository
{
    public function getModel()
    {
        return Answer::class;
    }

    public function findIdCorrectAnswer(int $questionId)
    {
        return $this
            ->model
            ->where('question_id', $questionId)
            ->where('is_correct', Common::CORRECTED_ANSWER)
            ->pluck('id')
            ->first();
    }
}

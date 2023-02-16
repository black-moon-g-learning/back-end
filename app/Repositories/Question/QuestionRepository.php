<?php

namespace App\Repositories\Question;

use App\Models\Question;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class QuestionRepository extends BaseRepository implements IQuestionRepository
{
    public function getModel()
    {
        return Question::class;
    }

    public function getAllQuestionInVideo(int $videoId): Collection
    {
        return $this
            ->model
            ->where('video_id', $videoId)
            ->with('answers')
            ->get();
    }
}

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
    public function getQuestionsInCountryAdmin(int $countryId): mixed
    {
        return $this->model->with([
            'correctAnswer' => function ($query) {
                $query->where('is_correct', 1);
            }
        ])
            ->where('country_id', $countryId)->paginate(20);
    }

    public function getAQuestionWithAnswers(int $id): mixed
    {
        return $this->model->with('answers')->find($id);
    }
}

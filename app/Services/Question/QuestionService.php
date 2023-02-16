<?php

namespace App\Services\Question;

use App\Repositories\Question\IQuestionRepository;
use Illuminate\Support\Collection;

class QuestionService implements IQuestionService
{
    protected IQuestionRepository $questionRepo;

    public function __construct(IQuestionRepository $questionRepo)
    {
        $this->questionRepo = $questionRepo;
    }

    public function getAllQuestionInVideo(int $videoId): Collection
    {
        return $this->questionRepo->getAllQuestionInVideo($videoId);
    }
}

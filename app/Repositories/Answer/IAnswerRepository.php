<?php

namespace App\Repositories\Answer;

use App\Repositories\RepositoryInterface;

interface IAnswerRepository extends RepositoryInterface
{
    public function findIdCorrectAnswer(int $questionId);
}

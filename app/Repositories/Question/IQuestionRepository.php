<?php

namespace App\Repositories\Question;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Collection;

interface IQuestionRepository extends RepositoryInterface
{
    public function getAllQuestionInVideo(int $videoId): Collection;

    public function getQuestionsInCountryAdmin(int $countryId): mixed;

    public function getAQuestionWithAnswers(int $id): mixed;
}

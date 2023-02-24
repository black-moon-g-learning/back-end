<?php

namespace App\Services\Question;

use Illuminate\Support\Collection;

interface IQuestionService
{
    public function getAllQuestionInVideo(int $videoId): Collection;

    public function indexAdmin(int $countryId): mixed;
}

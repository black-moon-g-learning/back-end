<?php

namespace App\Services\Question;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IQuestionService
{
    public function getAllQuestionInVideo(int $videoId): Collection;

    public function getAllQuestionInCountry(int $countryId): Collection;

    public function indexAdmin(int $countryId): mixed;

    public function update(Request $request, int $id): mixed;

    public function edit(int $id): mixed;

    public function store(Request $request): mixed;

    public function delete(Request $request, int $id): mixed;
}

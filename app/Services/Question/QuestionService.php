<?php

namespace App\Services\Question;

use App\Repositories\Answer\IAnswerRepository;
use App\Repositories\Question\IQuestionRepository;
use App\Services\Validate\QuizValidateService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class QuestionService implements IQuestionService
{
    protected IQuestionRepository $questionRepo;

    protected IAnswerRepository $answerRepo;

    public function __construct(
        IQuestionRepository $questionRepo,
        IAnswerRepository $answerRepo
    ) {
        $this->questionRepo = $questionRepo;
        $this->answerRepo = $answerRepo;
    }

    public function getAllQuestionInVideo(int $videoId): Collection
    {
        return $this->questionRepo->getAllQuestionInVideo($videoId);
    }

    public function indexAdmin(int $countryId): mixed
    {
        return $this->questionRepo->getQuestionsInCountryAdmin($countryId);
    }

    public function update(Request $request, int $id): mixed
    {
        $validator = new QuizValidateService($request->all());
        $validated = $validator->afterValidated();

        if ($validated['status']) {

            $question['content'] = $validated['data']['question'];
            $answers = $validated['data']['answers'];
            $correctAnswerId = $validated['data']['correct_answer'];

            $updatedQuestion = $this->questionRepo->update($id, $question);
            $updatedAnswer =  $this->updateForAnswer($answers, $correctAnswerId);
            if ($updatedQuestion &&  $updatedAnswer) {
                return [
                    'status' => true,
                    'data' => 'update Question successful',
                    'countryId' => $updatedQuestion->country_id
                ];
            }
            return [
                'status' => false,
                'data' => 'Can not update now',
            ];
        }
        return $validated;
    }

    public function edit(int $id): mixed
    {
        return $this->questionRepo->getAQuestionWithAnswers($id);
    }

    public function updateForAnswer(array $answers, int $correctAnswerId): bool
    {
        foreach ($answers as $id => $content) {

            $answer['content'] = $content;

            if ($id == $correctAnswerId) {
                $answer['is_correct'] = 1;
            } else {
                $answer['is_correct'] = 0;
            }

            if (!$this->answerRepo->update($id, $answer)) {
                return false;
            };
        }
        return true;
    }
}

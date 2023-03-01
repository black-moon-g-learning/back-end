<?php

namespace App\Services\Question;

use App\Repositories\Answer\IAnswerRepository;
use App\Repositories\Question\IQuestionRepository;
use App\Services\Storage\IStorageService;
use App\Services\Validate\QuizValidateService;
use App\Services\Validate\ReviewValidateService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class QuestionService implements IQuestionService
{
    protected IQuestionRepository $questionRepo;

    protected IAnswerRepository $answerRepo;

    protected IStorageService $storeSer;

    public function __construct(
        IQuestionRepository $questionRepo,
        IAnswerRepository $answerRepo,
        IStorageService $storeSer
    ) {
        $this->questionRepo = $questionRepo;
        $this->answerRepo = $answerRepo;
        $this->storeSer = $storeSer;
    }

    public function getAllQuestionInVideo(int $videoId): Collection
    {
        return $this->questionRepo->getAllQuestionInVideo($videoId);
    }

    public function getAllQuestionInCountry(int $countryId): Collection
    {
        return $this->questionRepo->getAllQuestionInCountry($countryId);
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

    public function createAnswer(array $answers, string $correctAnswerCharacter, int $questionId): bool
    {
        foreach ($answers as $character => $content) {

            $answer['content'] = $content;
            $answer['question_id'] = $questionId;

            if ($character == $correctAnswerCharacter) {
                $answer['is_correct'] = 1;
            } else {
                $answer['is_correct'] = 0;
            }

            if (!$this->answerRepo->create($answer)) {
                return false;
            };
        }
        return true;
    }

    public function store(Request $request): mixed
    {
        if ($request->has('video-id')) {
            return $this->storeReview($request);
        }
        return $this->storeQuestion($request);
    }

    public function delete(Request $request, int $id): mixed
    {
        $deletedQuestion = $this->questionRepo->delete($id);
        $countryId = $request->get('country-id');

        if ($deletedQuestion) {
            return [
                'status' => true,
                'data' => 'Delete Question successful',
                'countryId' => $countryId
            ];
        }
        return [
            'status' => false,
            'data' => 'Can not delete now',
        ];
    }

    public function storeReview(Request $request)
    {
        $validator = new ReviewValidateService($request->all());
        $validated = $validator->afterValidated();

        if ($validated['status']) {

            $question['content'] = $validated['data']['question'];
            $question['video_id'] = $request->get('video-id');

            $answers = $validated['data']['answers'];
            $correctAnswerId = $validated['data']['correct_answer'];

            $createdQuestion = $this->questionRepo->create($question);

            $createdAnswer =  $this->createAnswerImage($answers, $correctAnswerId, $createdQuestion->id, $request);

            if ($createdQuestion &&  $createdAnswer) {
                return [
                    'status' => true,
                    'data' => 'create Question successful',
                    'countryId' => $createdQuestion->country_id
                ];
            }
            return [
                'status' => false,
                'data' => 'Can not update now',
            ];
        }
        return $validated;
    }


    public function storeQuestion(Request $request)
    {
        $validator = new QuizValidateService($request->all());
        $validated = $validator->afterValidated();

        if ($validated['status']) {

            $question['content'] = $validated['data']['question'];
            $question['country_id'] = $request->get('country-id');

            $answers = $validated['data']['answers'];
            $correctAnswerId = $validated['data']['correct_answer'];

            $createdQuestion = $this->questionRepo->create($question);

            $createdAnswer =  $this->createAnswer($answers, $correctAnswerId, $createdQuestion->id);

            if ($createdQuestion &&  $createdAnswer) {
                return [
                    'status' => true,
                    'data' => 'update Question successful',
                    'countryId' => $createdQuestion->country_id
                ];
            }
            return [
                'status' => false,
                'data' => 'Can not update now',
            ];
        }
        return $validated;
    }

    public function createAnswerImage(array $answers, string $correctAnswerCharacter, int $questionId, Request $request): bool
    {

        $index = 0;
        $characters = ['A', 'B', 'C', 'D'];

        foreach ($request->file('answers') as $file) {

            $uploaded = $this->storeSer->upload($file, 'reviews');
            if ($uploaded['status']) {
                $answer['image'] = $uploaded['url'];
                $answer['question_id'] = $questionId;

                if ($characters[$index] == $correctAnswerCharacter) {
                    $answer['is_correct'] = 1;
                } else {
                    $answer['is_correct'] = 0;
                }
                if (!$this->answerRepo->create($answer)) {
                    return false;
                };
            } else {
                return false;
            }
            $index++;

        }
        return true;
    }
}

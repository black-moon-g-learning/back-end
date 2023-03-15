<?php

namespace App\Services\Question;

use App\Constants\Common;
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
        if ($request->get('video-id')) {
            return $this->updateReview($request, $id);
        }
        return $this->updateQuestion($request, $id);
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
        $question = $this->questionRepo->find($id);

        foreach ($question->answers as $answer) {
            $this->storeSer->delete($answer->image);
        }

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

            $correctAnswerId = $validated['data']['correct_answer'];

            $createdQuestion = $this->questionRepo->create($question);

            $createdAnswer =  $this->createAnswerImage($correctAnswerId, $createdQuestion->id, $request);

            if ($createdQuestion &&  $createdAnswer) {
                return [
                    'status' => true,
                    'data' => 'create Question successful',
                    'videoId' => $createdQuestion->video_id
                ];
            }
            return [
                'status' => false,
                'data' => 'Can not create now',
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

    public function createAnswerImage(string $correctAnswerCharacter, int $questionId, Request $request): bool
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

    public function updateQuestion(Request $request, int $id)
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

    public function updateReview(Request $request, int $id)
    {
        $validator = new ReviewValidateService($request->all());
        $validated = $validator->afterValidated();

        if ($validated['status']) {

            $question['content'] = $validated['data']['question'];
            $correctAnswerId = $validated['data']['correct_answer'];

            $updatedQuestion = $this->questionRepo->update($id, $question);
            $updatedAnswer =  $this->updateForAnswerReview($request, $correctAnswerId, $id);
            if ($updatedQuestion &&  $updatedAnswer) {
                return [
                    'status' => true,
                    'data' => 'update Question successful',
                    'videoId' => $updatedQuestion->video_id
                ];
            }
            return [
                'status' => false,
                'data' => 'Can not update now',
            ];
        }
        return $validated;
    }

    public function updateForAnswerReview(Request $request, int $correctAnswerId, int $questionId)
    {

        $updatedCorrectAnswer = 0;
        if ($request->file('answers') !== null) {

            foreach ($request->file('answers') as $id => $file) {

                $answerDB = $this->answerRepo->find($id);

                $this->storeSer->delete($answerDB->image);

                $uploaded = $this->storeSer->upload($file, 'reviews');

                if ($uploaded['status']) {
                    $answer['image'] = $uploaded['url'];

                    if ($id == $correctAnswerId) {
                        $answer['is_correct'] = Common::CORRECTED_ANSWER;
                        $updatedCorrectAnswer++;
                    } else {
                        $answer['is_correct'] = Common::UNCORRECTED_ANSWER;
                    }

                    if (!$this->answerRepo->update($id, $answer)) {
                        return false;
                    };
                } else {
                    return false;
                }
            }
        }

        if ($updatedCorrectAnswer === 0) {

            $answer['is_correct'] = Common::CORRECTED_ANSWER;
            $uncorrectedAnswer['is_correct'] = Common::UNCORRECTED_ANSWER;

            $correctedId = $this->answerRepo->findIdCorrectAnswer($questionId);

            $this->answerRepo->update($correctedId, $uncorrectedAnswer);
            $this->answerRepo->update($correctAnswerId, $answer);
            
        }
        return true;
    }
}

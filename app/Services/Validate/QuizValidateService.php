<?php

namespace App\Services\Validate;

class QuizValidateService extends ValidateService implements IValidateService
{
    public function setFieldValidate(): array
    {
        return [
            'question' => 'required',
            'answers.*' => 'required',
            'correct_answer' => 'required'
        ];
    }
}

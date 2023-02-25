<?php

namespace App\Services\Validate;

use Illuminate\Support\Facades\Validator;

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

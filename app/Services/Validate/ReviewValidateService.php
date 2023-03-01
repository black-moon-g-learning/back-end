<?php

namespace App\Services\Validate;

use App\Services\Video\IVideoService;

class ReviewValidateService extends ValidateService implements IValidateService
{
    public function setFieldValidate(): array
    {
        return [
            'question' => 'required',
            'answers.*' => request()->method() === 'POST'
                ? 'required'
                : 'nullable' . '|mimes:jpeg,png,jpg,gif|max:8129|file',
            'correct_answer' => 'required'
        ];
    }
}

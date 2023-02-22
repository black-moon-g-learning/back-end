<?php

namespace App\Services\Validate;

class VideoValidateService extends ValidateService
{
    public function setFieldValidate(): array
    {
        return array_merge(
            parent::setFieldValidate(),
            [
                'time' => 'required|integer|min:1',
            ]
        );
    }
}

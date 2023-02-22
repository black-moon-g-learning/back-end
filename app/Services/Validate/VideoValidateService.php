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
                'youtube_url' => 'nullable|string|min:2',
                'country_topic_id' => 'nullable'
            ]
        );
    }
}

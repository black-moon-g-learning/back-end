<?php

namespace App\Services\Validate;

class VideoValidateService extends ValidateService implements IValidateService
{
    public function setFieldValidate(): array
    {
        return array_merge(
            parent::setFieldValidate(),
            [
                'time' => 'required|integer|min:1',
                'video_url' => 'required|string|min:2',
                'country_topic_id' => 'nullable'
            ]
        );
    }
}

<?php

namespace App\Services\Validate;

use Illuminate\Support\Facades\Validator;

class ValidateService implements IValidateService
{

    protected bool $status = true;

    protected bool $hasFile = false;

    protected $validated;

    public function __construct(array $needValidate)
    {
        $this->validated = Validator::make($needValidate, $this->setFieldValidate());

        if ($this->validated->fails()) {
            $this->status = false;
        };
    }

    public function afterValidated(): array
    {
        $response['status'] = $this->status;

        if ($this->status) {
            $response['data'] = $this->validated->validated();

            if (isset($response['data']['file'])) {
                $this->hasFile = true;
            }
        } else {
            $response['data'] = $this->validated->errors()->toArray();
        }

        return $response;
    }


    public function getHasFile(): bool
    {
        return $this->hasFile;
    }

    public function setFieldValidate(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif|max:8129|file'
        ];
    }
}

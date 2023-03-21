<?php


namespace App\Services\Validate;

class PackageValidateService extends ValidateService implements IValidateService
{
    public function setFieldValidate(): array
    {
        return [
            'name' => 'required',
            'price' =>   'required',
            'description' => 'nullable',
            'time' => 'nullable|integer'
        ];
    }
}

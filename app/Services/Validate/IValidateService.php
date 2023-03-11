<?php

namespace App\Services\Validate;

interface IValidateService
{
    public function afterValidated(): array;

    public function setFieldValidate(): array;

    public function getHasFile(): bool;
}

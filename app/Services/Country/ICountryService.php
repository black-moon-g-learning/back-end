<?php

namespace App\Services\Country;

interface ICountryService
{
    public function index();

    public function getAttributeCountries(string $attribute);
}

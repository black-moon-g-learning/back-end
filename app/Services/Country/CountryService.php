<?php

namespace App\Services\Country;

use App\Repositories\Country\ICountryRepository;

class CountryService implements ICountryService
{
    protected ICountryRepository $countryRepo;

    public function __construct(ICountryRepository $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }

    public function index()
    {
        return $this->countryRepo->getCountries();
    }

    public function getAttributeCountries(string $attribute)
    {
        $field = ['id', $attribute];
        return $this->countryRepo->getAttributeCountries($field);;
    }
}

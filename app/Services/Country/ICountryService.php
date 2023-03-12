<?php

namespace App\Services\Country;

use Illuminate\Http\Request;

interface ICountryService
{
    public function index();

    public function getAttributeCountries(string $attribute);

    public function getCountriesInContinent(int $continentId);

    public function getAllCountries(?int $paginate);

    public function edit(int $id);

    public function update(Request $request, int $id);
}

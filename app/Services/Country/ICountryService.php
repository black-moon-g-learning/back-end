<?php

namespace App\Services\Country;

use Illuminate\Http\Request;

interface ICountryService
{
    public function index();

    public function getAttributeCountries(string $attribute);

    public function getCountriesInContinent(int $continentId);

    public function edit(int $id);

    public function update(Request $request, int $id);

    public function storeUserPlayGame(Request $request);
}

<?php

namespace App\Services\CountryTopic;

use Illuminate\Http\Request;

interface ICountryTopicService
{
    public function index(int $countryId);

    public function storeTopic(Request $request, int $countryId);

    public function delete(int $id);
}

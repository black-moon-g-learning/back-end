<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Country\ICountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    protected ICountryService $countrySer;

    public function __construct(ICountryService $countrySer)
    {
        $this->countrySer = $countrySer;
    }

    public function index(Request $request)
    {
        if ($request->has('attribute')) {
            return $this->countrySer->getAttributeCountries($request->get('attribute'));
        }
        return $this->countrySer->index();
    }
}
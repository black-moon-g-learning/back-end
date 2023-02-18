<?php

namespace App\Http\Controllers\Web;

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
        // Set default continent
        $continentId = 1;

        if ($request->has('cont')) {
            $continentId = $request->get('cont');
        }

        $countries = $this->countrySer->getCountriesInContinent($continentId);

        return view('pages.countries', compact('countries'));
    }
}

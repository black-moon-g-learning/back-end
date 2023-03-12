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
        $continentId = null;

        if ($request->has('cont')) {
            $continentId = $request->get('cont');
            $countries = $this->countrySer->getCountriesInContinent($continentId);
        } else {
            $countries = $this->countrySer->getAllCountries(30);
        }

        return view('pages.countries', compact('countries', 'continentId'));
    }

    public function edit(int $id)
    {
        $country = $this->countrySer->edit($id);
        return view('forms.country', compact('country'));
    }

    public function update(Request $request, int $id)
    {
        $response =  $this->countrySer->update($request, $id);

        if ($response["status"]) {
            return redirect()->route('web.countries')->with('response', $response);
        }
        return redirect()->back()->with("errors", $response["errors"]);
    }
}

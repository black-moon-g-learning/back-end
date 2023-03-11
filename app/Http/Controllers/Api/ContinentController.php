<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ContinentResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Repositories\Continent\IContinentRepository;
use App\Repositories\Country\ICountryRepository;
use App\Utils\Response;
use Illuminate\Http\Request;

class ContinentController extends Controller
{

    use Response;
    protected $continentRepo;

    protected ICountryRepository $countryRepo;

    /**
     * @param IContinentRepository $continentRepo
     */
    public function __construct(
        IContinentRepository $continentRepo,
        ICountryRepository $countryRepo
    ) {
        $this->continentRepo = $continentRepo;
        $this->countryRepo = $countryRepo;
    }

    /**
     * @return mixed
     */
    public function index()
    {

        $continents = $this->continentRepo->getAll();
        $response = collect(ContinentResource::collection($continents));

        return $this->responseSuccessWithData($response->toArray(), 200);
    }

    public function getCountries(Request $request, int $id)
    {
        if ($request->has('s')) {

            $countriesSearched = $this->countryRepo->searchCountries($id, $request->get('s'));
            $response = collect(CountryResource::collection($countriesSearched))->toArray();
            return $this->responseSuccessWithData($response, 200);
            
        }
        $countries = $this->continentRepo->getCountries($id);

        return $this->responseSuccessWithData($countries, 200);
    }
}

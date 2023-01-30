<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContinentResource;
use App\Repositories\Continent\IContinentRepository;
use App\Utils\Response;

class ContinentController extends Controller
{

    use Response;
    protected $continentRepo;

    /**
     * @param IContinentRepository $continentRepo
     */
    public function __construct(IContinentRepository $continentRepo)
    {
        $this->continentRepo = $continentRepo;
    }

    /**
     * @return mixed
     */
    public function index(){

        $continents = $this->continentRepo->getAll();
        $response = collect(ContinentResource::collection($continents));

        return $this->responseSuccessWithData($response->toArray(),200);
    }

}

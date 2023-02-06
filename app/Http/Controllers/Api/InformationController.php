<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Information\IInformationService;
use App\Utils\Response;
use Illuminate\Http\JsonResponse;

class InformationController extends Controller
{
    protected IInformationService $informationRepo;

    public function __construct(IInformationService $informationRepo)
    {
        $this->informationRepo = $informationRepo;
    }


    /**
     * @return Response|JsonResponse
     */
    public function index()
    {
        $response = $this->informationRepo->index();
        return $this->responseSuccessWithData($response->toArray());
    }
}

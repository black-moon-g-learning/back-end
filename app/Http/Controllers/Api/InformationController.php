<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationRequest;
use App\Services\Information\IInformationService;
use App\Utils\Response;
use Illuminate\Http\JsonResponse;

class InformationController extends Controller
{
    protected IInformationService $informationSer;

    public function __construct(IInformationService $informationSer)
    {
        $this->informationSer = $informationSer;
    }

    /**
     * @return Response|JsonResponse
     */
    public function index()
    {
        $response = $this->informationSer->index();
        return $this->responseSuccessWithData($response);
    }

    /**
     * create
     *
     *  @param  InformationRequest $infoRequest
     *  @return Response|JsonResponse
     */
    public function create(InformationRequest $infoRequest)
    {
        $response = $this->informationSer->create($infoRequest);
        return $this->responseSuccessWithData($response, 201);
    }
}

<?php

namespace App\Services\Information;

use App\Constants\Information;
use App\Http\Requests\InformationRequest;
use App\Http\Resources\InformationResource;
use App\Repositories\Information\IInformationRepository;

class InformationService implements IInformationService
{
    protected IInformationRepository $informationRepo;

    public function __construct(IInformationRepository $contributeRepo)
    {
        $this->informationRepo = $contributeRepo;
    }

    public function index()
    {
        $response =  $this->informationRepo->paginatePage();
        return collect(InformationResource::collection($response))->toArray();
    }

    public function create(InformationRequest $informationRequest): mixed
    {
        $attribute = $informationRequest->validated();
        $attribute['status'] = Information::PENDING;
        $attribute['image'] = $informationRequest->file('image')->getClientOriginalName();

        return [
            'status' => true,
        ];
    }
}

<?php

namespace App\Services\Information;

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
}

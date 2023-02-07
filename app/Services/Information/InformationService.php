<?php

namespace App\Services\Information;

use App\Constants\Information;
use App\Http\Requests\InformationRequest;
use App\Http\Resources\InformationResource;
use App\Repositories\Information\IInformationRepository;
use App\Services\Storage\IStorageService;

class InformationService implements IInformationService
{
    protected IInformationRepository $informationRepo;

    protected IStorageService $storageSer;

    public function __construct(
        IInformationRepository $contributeRepo,
        IStorageService $storageSer
    ) {
        $this->informationRepo = $contributeRepo;
        $this->storageSer = $storageSer;
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
        $attribute['image'] = $informationRequest
            ->file('image')
            ->getClientOriginalName();

        $uploaded = $this
            ->storageSer
            ->upload(
                $informationRequest->file('image'),
                Information::ROOT_FOLDER
            );

        if ($uploaded['status']) {

            $attribute['image'] = $uploaded['url'];

            $this->informationRepo->create($attribute);

            return [
                'status' => true,
                'message' => 'Upload successful, Admin will check this contribute soon'
            ];
        }

        return [
            'status' => false,
            'message' => 'Can not upload this file'
        ];
    }
}

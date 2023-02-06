<?php

namespace App\Services\Information;

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
        return $this->informationRepo->paginatePage();
    }
}

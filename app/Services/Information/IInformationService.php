<?php

namespace App\Services\Information;

use App\Http\Requests\InformationRequest;

interface IInformationService
{
    public function index();

    public function create(InformationRequest $informationRequest): mixed;

    public function getAll();

    public function edit(int $id);
}

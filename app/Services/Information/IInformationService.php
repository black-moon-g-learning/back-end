<?php

namespace App\Services\Information;

use App\Http\Requests\InformationRequest;
use Illuminate\Http\Request;

interface IInformationService
{
    public function index(Request $request);

    public function create(InformationRequest $informationRequest): mixed;

    public function getAll(Request $request);

    public function edit(int $id);

    public function update(Request $request, int $id);

    public function delete(int $id);

    public function createInfo();

    public function store(Request $request);
}

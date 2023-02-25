<?php

namespace App\Services\Level;

use Illuminate\Http\Request;

interface ILevelService
{
    public function index(): array;

    public function indexAdmin(): mixed;

    public function edit(int $id): mixed;

    public function update(Request $request, int $id): array;

    public function store(Request $request): mixed;

    public function delete(int $id);
}

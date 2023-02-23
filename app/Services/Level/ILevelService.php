<?php

namespace App\Services\Level;

interface ILevelService
{
    public function index(): array;

    public function indexAdmin(): mixed;
}

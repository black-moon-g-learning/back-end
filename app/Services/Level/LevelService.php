<?php

namespace App\Services\Level;

use App\Repositories\Level\ILevelRepository;

class LevelService implements ILevelService
{

    protected ILevelRepository $levelRepo;

    public function __construct(ILevelRepository $levelRepo)
    {
        $this->levelRepo = $levelRepo;
    }

    public function index(): array
    {
        $response = $this->levelRepo->getAll()->toArray();
        return $response;
    }
}

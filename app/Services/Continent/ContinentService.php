<?php

namespace App\Services\Continent;

use App\Repositories\Continent\IContinentRepository;
use Aws\History;

class ContinentService implements IContinentService
{
    protected IContinentRepository $continentRepo;

    public function __construct(IContinentRepository $continentRepo)
    {
        $this->continentRepo = $continentRepo;
    }

    public function index()
    {
        return $this->continentRepo->getAll();
    }

    public function update()
    {
        return 3;
    }
    public function show()
    {
        return 3;
    }
    
    public function edit(int $id)
    {
        return $this->continentRepo->find($id);
    }
}

<?php

namespace App\Repositories\Level;

use App\Models\GameLevel;
use App\Repositories\BaseRepository;

class LevelRepository extends BaseRepository implements ILevelRepository
{
    public function getModel()
    {
        return GameLevel::class;
    }
}

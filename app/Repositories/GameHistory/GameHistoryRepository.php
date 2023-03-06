<?php

namespace App\Repositories\GameHistory;

use App\Models\GamesHistory;
use App\Repositories\BaseRepository;

class GameHistoryRepository extends BaseRepository implements IGameHistoryRepository
{
    public function getModel()
    {
        return GamesHistory::class;
    }

    public function findUserPlayGame(int $userId, int $countryId, int $levelId = 1): mixed
    {
        $history = $this->model
            ->where('owner_id', $userId)
            ->where('country_id', $countryId)
            ->where('level_id', $levelId)
            ->first();

        if ($history) {
            return $history;
        }
        return false;
    }

    public function finByUserIdAndCountryId(int $userId, int $countryId)
    {
        return $this->model
            ->where('owner_id', $userId)
            ->where('country_id', $countryId)
            ->first();
    }
}

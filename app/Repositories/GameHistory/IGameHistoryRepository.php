<?php

namespace App\Repositories\GameHistory;

use App\Repositories\RepositoryInterface;

interface IGameHistoryRepository extends RepositoryInterface
{
    public function findUserPlayGame(int $userId, int $countryId, int $levelId = 1): mixed;

    public function finByUserIdAndCountryId(int $userId, int $countryId);
}

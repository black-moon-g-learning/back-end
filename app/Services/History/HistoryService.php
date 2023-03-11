<?php

namespace App\Services\History;

use App\Constants\Common;
use App\Repositories\GameHistory\IGameHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryService implements IHistoryService
{

    protected IGameHistoryRepository $gamHistoryRepo;

    public function __construct(IGameHistoryRepository $gamHistoryRepo)
    {
        $this->gamHistoryRepo = $gamHistoryRepo;
    }

    public function storeUserPlayGame(Request $request, int $countryId)
    {
        $user = Auth::user();
        $data = array();

        $data['total_correct_answers'] =  $request->get('total_correct_answers');
        $data['total_questions'] = $request->get('total_questions');
        $data['country_id'] = $countryId;

        $userPlayGame = $this->gamHistoryRepo->finByUserIdAndCountryId($user->id, $countryId);

        if ($userPlayGame) {
            $this->gamHistoryRepo->update($userPlayGame->id, $data);
        } else {
            $data['level_id'] = Common::DEFAULT_LEVEL_ID;
            $data['owner_id'] = $user->id;
            $this->gamHistoryRepo->create($data);
        }
    }
}

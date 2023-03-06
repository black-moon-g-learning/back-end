<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\History\IHistoryService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    protected IHistoryService $historySer;

    public function __construct(IHistoryService $historySer)
    {
        $this->historySer = $historySer;
    }
    public function storeUserPlayGame(Request $request, int $countryId)
    {
        $this->historySer->storeUserPlayGame($request, $countryId);
        return $this->responseSuccess(201);
    }
}

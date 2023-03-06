<?php

namespace App\Services\History;

use Illuminate\Http\Request;

interface IHistoryService
{
    public function storeUserPlayGame(Request $request, int $countryId);
}

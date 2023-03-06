<?php

namespace App\Services\Watched;

use Illuminate\Http\Request;

interface IWatchedService
{
    public function storeUserWatched(Request $request, int $videoId);
}

<?php

namespace App\Repositories\Information;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface IInformationRepository extends RepositoryInterface
{
    public function paginatePage(int $page = 10, ?int $countryId);

    public function countInfo();

    public function getUserContribute();

    public function indexAdmin(Request $request);
}

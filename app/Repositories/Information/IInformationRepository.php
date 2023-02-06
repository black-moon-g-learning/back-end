<?php

namespace App\Repositories\Information;

use App\Repositories\RepositoryInterface;

interface IInformationRepository extends RepositoryInterface
{
    public function paginatePage(int $page = 10);
}

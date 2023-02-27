<?php

namespace App\Repositories\Information;

use App\Constants\Information;
use App\Models\Contribute;
use App\Repositories\BaseRepository;

class InformationRepository extends BaseRepository implements IInformationRepository
{
    protected $limit = 10;

    /**
     * getModel
     *
     * @return Contribute
     */
    public function getModel()
    {
        return Contribute::class;
    }

    /**
     * paginatePage
     *
     * @param  int|null $page
     * @return void
     */
    public function paginatePage(int $page = 10)
    {
        return $this->model
            ->where('status', '=', Information::PUBLISHED)
            ->with(['user', 'country'])
            ->orderBy('id', 'desc')
            ->paginate($page);
    }

    public function getAll()
    {
        return $this->model
            ->with(['user', 'country'])
            ->orderBy('status', 'desc')
            ->paginate($this->limit);
    }

    public function countInfo()
    {
        return $this
            ->model
            ->where('status', Information::PUBLISHED)
            ->count();
    }
}

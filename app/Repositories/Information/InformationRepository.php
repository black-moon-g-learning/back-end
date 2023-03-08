<?php

namespace App\Repositories\Information;

use App\Constants\Information;
use App\Models\Contribute;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

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
    public function paginatePage(int $page = 10, ?int $countryId)
    {
        $query = $this->model
            ->where('status', '=', Information::PUBLISHED)
            ->with(['user', 'country'])
            ->orderBy('id', 'desc');

        if ($countryId) {
            $query->where('country_id', $countryId);
        }

        return $query->paginate($page);
    }

    public function indexAdmin(Request $request)
    {
        $query = $this->model
            ->with(['user', 'country']);

        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }
        return $query
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

    public function getUserContribute()
    {
        return $this->model
            ->join('users', 'users.id', '=', 'contributes.owner_id')
            ->selectRaw('users.first_name
                ,COUNT(owner_id) as totals
                ,SUM(status=' . Information::PENDING . ')  AS pending
                ,SUM(status=' . Information::PUBLISHED . ') AS published
                ,SUM(status=' . Information::FUTURE . ') AS future')
            ->groupBy('owner_id')
            ->orderBy('totals', 'desc')
            ->paginate(10);
    }
}

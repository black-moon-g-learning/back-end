<?php

namespace App\Services\Country;

use App\Repositories\Country\ICountryRepository;
use App\Repositories\GameHistory\IGameHistoryRepository;
use App\Services\Storage\IStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CountryService implements ICountryService
{
    protected ICountryRepository $countryRepo;

    protected IStorageService $storeSer;

    protected IGameHistoryRepository $gameRepo;

    protected int $limit = 20;

    public function __construct(
        ICountryRepository $countryRepo,
        IStorageService $storeSer,
        IGameHistoryRepository $gameRepo
    ) {
        $this->countryRepo = $countryRepo;
        $this->storeSer = $storeSer;
        $this->gameRepo = $gameRepo;
    }

    public function index()
    {
        $user = Auth::user();

        $countries = $this->countryRepo->getCountries($user->id);
        $countries->setCollection($countries->getCollection()->transform(function ($item) {

            $total = $item->usersPlayGame->total_questions ?? 1;
            $correct = $item->usersPlayGame->total_correct_answers ?? 0;

            $percent = calPercent($correct, $total);

            $item->setField($percent);
            return $item;
        }));
        return $countries;
    }

    public function getAttributeCountries(string $attribute)
    {
        $unlimited = 1000;

        $field = ['id', $attribute];
        return $this->countryRepo->getAttributeCountries($field, $unlimited);
    }

    public function getCountriesInContinent(int $continentId)
    {
        return $this->countryRepo->getCountriesInContinent($continentId, $this->limit);
    }

    public function edit(int $id)
    {
        return $this->countryRepo->find($id);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpeg,png,jpg,gif|max:8129|file',
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $country = $validator->validated();

        if ($request->has('file')) {
            $countryDB = $this->countryRepo->find($id);
            if ($this->storeSer->exists($countryDB->image)) {
                $this->storeSer->delete($countryDB->image);
            }

            $file = $request->file('file');
            $uploaded = $this->storeSer->upload($file, 'countries');



            if ($uploaded['status']) {
                $country['image'] = $uploaded['url'];
            }
        }

        $this->countryRepo->update($id, $country);

        return [
            "status" => true,
            "data" => "Update successful"
        ];
    }


    public function setupDataForHistory(Request $request)
    {
        $user = Auth::user();

        $gameHistory['owner_id'] = $user->id ?? 1;
        $gameHistory['country_id'] = $request->get('country_id') ?? 1;
        $gameHistory['level_id'] = $request->get('level_id') ?? 1;
        $gameHistory['total_questions'] = $request->get('total_questions') ?? 1;
        $gameHistory['total_correct_answers'] = $request->get('total_correct_answers') ?? 0;

        return $gameHistory;
    }
}

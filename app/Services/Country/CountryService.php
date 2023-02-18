<?php

namespace App\Services\Country;

use App\Repositories\Country\ICountryRepository;
use App\Services\Storage\IStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryService implements ICountryService
{
    protected ICountryRepository $countryRepo;

    protected IStorageService $storeSer;

    protected int $limit = 20;

    public function __construct(
        ICountryRepository $countryRepo,
        IStorageService $storeSer
    ) {
        $this->countryRepo = $countryRepo;
        $this->storeSer = $storeSer;
    }

    public function index()
    {
        return $this->countryRepo->getCountries();
    }

    public function getAttributeCountries(string $attribute)
    {
        $field = ['id', $attribute];
        return $this->countryRepo->getAttributeCountries($field);;
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
            'description' => 'nullable',
            'place' => 'required|integer'
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
}

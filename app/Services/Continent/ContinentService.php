<?php

namespace App\Services\Continent;


use App\Repositories\Continent\IContinentRepository;
use App\Services\Storage\IStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContinentService implements IContinentService
{
    protected IContinentRepository $continentRepo;

    protected IStorageService $storeSer;

    public function __construct(IContinentRepository $continentRepo, IStorageService $storeSer)
    {
        $this->continentRepo = $continentRepo;
        $this->storeSer = $storeSer;
    }

    public function index()
    {
        return $this->continentRepo->getAll();
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpeg,png,jpg,gif|max:8129|file',
            'name' => 'required',
            'regions' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->errors()->toArray()
            ];
        }

        $continent = $validator->validated();
        $continent['quantity_regions'] = $continent['regions'];


        if (isset($continent['file'])) {

            $continentDB = $this->continentRepo->find($id);

            if ($this->storeSer->exists($continentDB->image)) {
                $this->storeSer->delete($continentDB->image);
            }

            $file = $request->file('file');
            $uploaded = $this->storeSer->upload($file, 'continents');

            if ($uploaded['status']) {
                $continent['image'] = $uploaded['url'];
            }
        }

        $this->continentRepo->update($id, $continent);


        return [
            "status" => true,
            "data" => "Update successful"
        ];
    }
    public function show()
    {
        return 3;
    }

    public function edit(int $id)
    {
        return $this->continentRepo->find($id);
    }
}

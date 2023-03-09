<?php

namespace App\Services\Information;

use App\Constants\Information;
use App\Http\Requests\InformationRequest;
use App\Http\Resources\InformationResource;
use App\Repositories\Country\ICountryRepository;
use App\Repositories\Information\IInformationRepository;
use App\Services\Storage\IStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InformationService implements IInformationService
{
    protected IInformationRepository $informationRepo;

    protected IStorageService $storageSer;

    protected ICountryRepository $countryRepo;

    public function __construct(
        IInformationRepository $contributeRepo,
        IStorageService $storageSer,
        ICountryRepository $countryRepo
    ) {
        $this->informationRepo = $contributeRepo;
        $this->storageSer = $storageSer;
        $this->countryRepo = $countryRepo;
    }

    public function index(Request $request)
    {
        $response =  $this->informationRepo->paginatePage(10, $request->get('country-id'));
        return collect(InformationResource::collection($response))->toArray();
    }

    public function create(InformationRequest $informationRequest): mixed
    {
        $attribute = $informationRequest->validated();
        $attribute['status'] = Information::PENDING;
        $attribute['image'] = $informationRequest
            ->file('image')
            ->getClientOriginalName();

        $uploaded = $this
            ->storageSer
            ->upload(
                $informationRequest->file('image'),
                Information::ROOT_FOLDER
            );

        if ($uploaded['status']) {

            $attribute['image'] = $uploaded['url'];

            $this->informationRepo->create($attribute);

            return [
                'status' => true,
                'message' => 'Upload successful, Admin will check this contribute soon'
            ];
        }

        return [
            'status' => false,
            'message' => 'Can not upload this file'
        ];
    }

    public function getAll(Request $request)
    {
        $response = $this->informationRepo->indexAdmin($request);
        return $response;
    }

    public function edit(int $id)
    {
        $countries = $this->getAllCountries();
        $info = $this->informationRepo->find($id);

        return [
            'countries' => $countries,
            'info' => $info
        ];
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpeg,png,jpg,gif|max:8129|file',
            'title' => 'required',
            'status' => 'nullable|required|integer',
            'country_id' => 'nullable|required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->errors()->toArray()
            ];
        }

        $info = $validator->validated();

        if ($request->has('file')) {
            $infoDB = $this->informationRepo->find($id);
            if ($this->storageSer->exists($infoDB->image)) {
                $this->storageSer->delete($infoDB->image);
            };
            $uploaded = $this
                ->storageSer
                ->upload(
                    $request->file('file'),
                    Information::ROOT_FOLDER
                );
            if ($uploaded['status']) {

                $info['image'] = $uploaded['url'];
            } else {
                return [
                    'status' => false,
                    'message' => 'Can not upload this file'
                ];
            }
        }

        $this->informationRepo->update($id, $info);

        return [
            'status' => true,
            'data' => 'Update information successful'
        ];
    }

    public function delete(int $id)
    {

        $infoDB = $this->informationRepo->find($id);
        if ($this->storageSer->exists($infoDB->image)) {
            $this->storageSer->delete($infoDB->image);
        };
        $deletedInfo =  $this->informationRepo->delete($id);
        if ($deletedInfo) {
            return [
                'status' => true,
                'data' => 'Delete post successful'
            ];
        } else {
            return [
                'status' => false,
                'data' => 'Can not delete now'
            ];
        }
    }

    public function createInfo()
    {
        $user = Auth::user();
        $countries = $this->getAllCountries();

        return [
            'countries' => $countries,
            'user' => $user
        ];
    }

    public function getAllCountries()
    {
        return $this->countryRepo->getAll();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'nullable|mimes:jpeg,png,jpg,gif|max:8129|file',
            'title' => 'required',
            'status' => 'required|integer',
            'country_id' => 'required',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->errors()->toArray()
            ];
        }

        $info = $validator->validated();

        if ($request->has('file')) {
            $uploaded = $this
                ->storageSer
                ->upload(
                    $request->file('file'),
                    Information::ROOT_FOLDER
                );
            if ($uploaded['status']) {
                $info['image'] = $uploaded['url'];
            } else {
                return [
                    'status' => false,
                    'message' => 'Can not upload this file'
                ];
            }
        }

        $user = Auth::user();
        $info['owner_id'] = $user->id;
        $this->informationRepo->create($info);

        return [
            'status' => true,
            'data' => 'Create information successful'
        ];
    }
}

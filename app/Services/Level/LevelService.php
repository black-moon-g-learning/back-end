<?php

namespace App\Services\Level;

use App\Repositories\Level\ILevelRepository;
use App\Services\Storage\IStorageService;
use App\Services\Validate\ValidateService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class LevelService implements ILevelService
{

    protected ILevelRepository $levelRepo;

    protected IStorageService $storeSer;

    public function __construct(
        ILevelRepository $levelRepo,
        IStorageService $storeSer
    ) {
        $this->levelRepo = $levelRepo;
        $this->storeSer = $storeSer;
    }

    public function index(): array
    {
        $response = $this->levelRepo->getAll()->toArray();
        return $response;
    }

    public function indexAdmin(): mixed
    {
        return $this->levelRepo->getAll();
    }

    public function edit(int $id): mixed
    {
        return $this->levelRepo->find($id);
    }

    public function update(Request $request, int $id): array
    {
        $validator = new ValidateService($request->all());
        $validated = $validator->afterValidated();
        if ($validated['status']) {

            $level = $validated['data'];
            $levelDB = $this->levelRepo->find($id);

            if ($validator->getHasFile()) {

                if ($this->storeSer->exists($levelDB->image)) {
                    $this->storeSer->delete($levelDB->image);
                }

                $file = $request->file('file');
                $level['image'] =  $this->uploadFile($file);
            }
            $this->levelRepo->update($id, $level);

            return [
                'status' => true,
                'data' => "Update level successful"
            ];
        }
        return $validated;
    }

    public function uploadFile(UploadedFile $file)
    {
        $uploaded = $this->storeSer->upload($file, 'levels');

        if ($uploaded['status']) {
            return $uploaded['url'];
        }
        return null;
    }

    public function store(Request $request): mixed
    {
        $validator = new ValidateService($request->all());
        $validated = $validator->afterValidated();

        if ($validated['status']) {
            $level = $validated['data'];

            if ($validator->getHasFile()) {
                $level['image'] =  $this->uploadFile($request->file('file'));
            }
            
            $this->levelRepo->create($level);

            return [
                'status' => true,
                'data' => "Create new level successful"
            ];
        }
        return  $validated;
    }
}

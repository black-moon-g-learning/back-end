<?php

namespace App\Services\Topic;

use App\Repositories\Topic\ITopicRepository;
use App\Services\Storage\IStorageService;
use App\Services\Validate\IValidateService;
use App\Services\Validate\ValidateService;
use Illuminate\Http\Request;

class TopicService implements ITopicService
{

    protected ITopicRepository $topicRepo;
    protected IStorageService $storeSer;

    public function __construct(
        ITopicRepository $topicRepo,
        IStorageService $storeSer,
    ) {
        $this->topicRepo = $topicRepo;
        $this->storeSer = $storeSer;
    }

    public function index()
    {
        return $this->topicRepo->getAllWithCountVideos(20);
    }

    public function edit(int $id)
    {
        return $this->topicRepo->editWithCountVideo($id);
    }

    public function update(Request $request, int $id)
    {
        $validator = new ValidateService($request->all());
        $validated = $validator->afterValidated();

        if ($validated['status']) {

            $topic = $validated['data'];
            $topicDB = $this->topicRepo->find($id);

            if ($validator->getHasFile()) {

                if ($this->storeSer->exists($topicDB->image)) {
                    $this->storeSer->delete($topicDB->image);
                }

                $file = $request->file('file');
                $uploaded = $this->storeSer->upload($file, 'topics');

                if ($uploaded['status']) {
                    $topic['image'] = $uploaded['url'];
                }
            }
            $this->topicRepo->update($id, $topic);

            return [
                'status' => true,
                'data' => "Update Topic successful"
            ];
        }

        return $validated;
    }
}

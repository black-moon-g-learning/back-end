<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Video\IVideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class VideoController extends Controller
{
    protected IVideoService $videoSer;

    public function __construct(IVideoService $videoSer)
    {
        $this->videoSer = $videoSer;
    }

    public function index(int $countryTopicId)
    {
        $videos =  $this->videoSer->indexWeb($countryTopicId);
        return view('pages.videos', compact('videos'));
    }

    public function edit(int $videoId)
    {
        $video = $this->videoSer->find($videoId);
        return view('forms.video', compact('video'));
    }

    public function update(Request $request, int $videoId)
    {
        // $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        // if (!$receiver->isUploaded()) {
        //     // file not uploaded
        // }

        // $fileReceived = $receiver->receive(); // receive file
        // if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
        //     $file = $fileReceived->getFile(); // get file
        //     $extension = $file->getClientOriginalExtension();
        //     $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
        //     $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

        //     $disk = Storage::disk('s3');
        //     $path = $disk->put('videos' . '/' . $fileName, file_get_contents($file));

        //     // delete chunked file
        //     unlink($file->getPathname());
        //     return [
        //         'path' =>  $path,
        //         'filename' => $fileName
        //     ];
        // }

        $response = $this->videoSer->update($request, $videoId);

        if ($response['status']) {
            return redirect()->route('web.countries-topics.videos', $request->get('country_topic_id'))->with('response', $response);
        }
        return redirect()->back()->with('errors', $response['data']);
    }
}

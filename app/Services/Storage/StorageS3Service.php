<?php

namespace App\Services\Storage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageS3Service implements IStorageService
{
    public function upload(UploadedFile $file, string $root): array
    {
        $fileName =  time() . '-' . $file->getClientOriginalName();
        $url = $root . '/' . $fileName;
        $status =  Storage::disk('s3')->put($url, file_get_contents($file));

        return [
            'status' => $status,
            'url' => $url
        ];
    }

    public function exists(?string $file): bool
    {
        if (isset($file)) {
            return Storage::disk('s3')->exists($file);
        }
        return false;
    }

    public function delete(string|null $file): bool
    {
        if ($file !== null && $this->exists($file)) {
            return Storage::disk('s3')->delete($file);
        };
        return false;
    }


    /**
     * uploadLargeFile
     * 
     * @param  UploadedFile $file
     * @param  string $fileName include root folder
     * @return array
     */
    public function uploadLargeFile(UploadedFile $file, string $fileName): array
    {
        $disk = Storage::disk('s3');
        if ($disk->put('videos' . '/' . $fileName, fopen($file, 'r+'))) {
            unlink($file->getPathname());
            return [
                'status' => true,
                'path' =>  "videos/" . $fileName,
            ];
        }

        return [
            'status' => false,
            'path' =>  null,
        ];
    }
}

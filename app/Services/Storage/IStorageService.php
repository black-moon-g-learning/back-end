<?php

namespace App\Services\Storage;

use Illuminate\Http\UploadedFile;

interface IStorageService
{
    public function upload(UploadedFile $file, string $root): array;
}

<?php

namespace App\Services\Video;

use Illuminate\Http\Request;

interface IVideoService
{
    public function search(int $countryTopicId, string $search);

    public function index(int $countryTopicId);

    public function formatResponse(string $type, mixed $data): array;

    public function indexWeb(int $countryTopicId): mixed;

    public function find(int $videoId): mixed;

    public function update(Request $request, int $videoId): array;

    public function store(Request $request): array;

    public function uploadVideo(Request $request): array;

    public function delete(int $id);
}

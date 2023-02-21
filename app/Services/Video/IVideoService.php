<?php

namespace App\Services\Video;

interface IVideoService
{
    public function search(int $countryTopicId, string $search);

    public function index(int $countryTopicId);

    public function formatResponse(string $type, mixed $data): array;

    public function indexWeb(int $countryTopicId): mixed;

    public function find(int $videoId): mixed;
}

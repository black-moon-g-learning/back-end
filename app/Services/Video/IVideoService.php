<?php

namespace App\Services\Video;

interface IVideoService
{
    public function search(int $countryTopicId, string $search);

    public function index(int $countryTopicId);

    public function formatResponse(string $type, mixed $data): array;
}

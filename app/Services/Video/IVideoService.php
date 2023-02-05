<?php

namespace App\Services\Video;

interface IVideoService
{
    public function search(int $countryTopicId, string $search);

    public function index(int $countryTopicId);
}

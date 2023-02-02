<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\VideoController;
use Mockery;
use Tests\TestCase;
use App\Repositories\Video\VideoRepository;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\JsonResponse;

class VideoControllerTest extends TestCase
{
    protected $videoRepo;
    public function test_get_model()
    {
        $this->videoRepo = new VideoRepository();
    
        $this->assertEquals($this->videoRepo->getModel(), Video::class);
    }

}

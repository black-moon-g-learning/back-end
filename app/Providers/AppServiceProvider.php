<?php

namespace App\Providers;

use App\Http\Resources\ContinentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            \App\Services\Video\IVideoService::class,
            \App\Services\Video\VideoService::class,
        );

        $this->app->bind(
            \App\Services\Information\IInformationService::class,
            \App\Services\Information\InformationService::class,
        );

        $this->app->bind(
            \App\Services\Storage\IStorageService::class,
            \App\Services\Storage\StorageS3Service::class,
        );

        $this->app->bind(
            \App\Services\Auth\IAuthService::class,
            \App\Services\Auth\WebAuthService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}

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

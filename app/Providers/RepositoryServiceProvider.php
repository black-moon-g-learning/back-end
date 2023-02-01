<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Continent\IContinentRepository::class,
            \App\Repositories\Continent\ContinentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Topic\ITopicRepository::class,
            \App\Repositories\Topic\TopicRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Video\IVideoRepository::class,
            \App\Repositories\Video\VideoRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

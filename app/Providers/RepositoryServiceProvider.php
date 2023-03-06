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

        $this->app->singleton(
            \App\Repositories\User\IUserRepository::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Information\IInformationRepository::class,
            \App\Repositories\Information\InformationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Country\ICountryRepository::class,
            \App\Repositories\Country\CountryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Country\ICountryRepository::class,
            \App\Repositories\Country\CountryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Question\IQuestionRepository::class,
            \App\Repositories\Question\QuestionRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Package\IPackageRepository::class,
            \App\Repositories\Package\PackageRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Level\ILevelRepository::class,
            \App\Repositories\Level\LevelRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CountryTopic\ICountryTopicRepository::class,
            \App\Repositories\CountryTopic\CountryTopicRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Answer\IAnswerRepository::class,
            \App\Repositories\Answer\AnswerRepository::class
        );

        $this->app->singleton(
            \App\Repositories\GameHistory\IGameHistoryRepository::class,
            \App\Repositories\GameHistory\GameHistoryRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\UserPayment\IUserPaymentRepository::class,
            \App\Repositories\UserPayment\UserPaymentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Watched\IWatchedRepository::class,
            \App\Repositories\Watched\WatchRepository::class
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

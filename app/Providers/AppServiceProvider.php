<?php

namespace App\Providers;

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


        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

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
            \App\Services\Continent\IContinentService::class,
            \App\Services\Continent\ContinentService::class
        );

        $this->app->bind(
            \App\Services\Auth\IAuthService::class,
            \App\Services\Auth\FirebaseAuthService::class
        );

        $this->app->bind(
            \App\Services\Country\ICountryService::class,
            \App\Services\Country\CountryService::class
        );

        $this->app
            ->when([\App\Http\Controllers\Web\AuthController::class])
            ->needs(\App\Services\Auth\IAuthService::class)
            ->give(\App\Services\Auth\WebAuthService::class);

        $this->app
            ->when([\App\Http\Controllers\Api\Auth\AuthController::class])
            ->needs(\App\Services\Auth\IAuthService::class)
            ->give(\App\Services\Auth\FirebaseAuthService::class);

        $this->app->bind(
            \App\Services\Question\IQuestionService::class,
            \App\Services\Question\QuestionService::class
        );

        $this->app->bind(
            \App\Services\Package\IPackageService::class,
            \App\Services\Package\PackageService::class
        );

        $this->app->bind(
            \App\Services\Level\ILevelService::class,
            \App\Services\Level\LevelService::class
        );

        $this->app->bind(
            \App\Services\User\IUserService::class,
            \App\Services\User\UserService::class
        );

        $this->app->bind(
            \App\Services\Topic\ITopicService::class,
            \App\Services\Topic\TopicService::class
        );

        $this->app->bind(
            \App\Services\CountryTopic\ICountryTopicService::class,
            \App\Services\CountryTopic\CountryTopicService::class
        );

        $this->app->bind(
            \App\Services\Dashboard\IDashboardService::class,
            \App\Services\Dashboard\DashboardService::class
        );

        $this->app->bind(
            \App\Services\Payment\IPaymentService::class,
            \App\Services\Payment\VNPayPaymentService::class
        );

        $this->app->bind(
            \App\Services\UserPayment\IUserPaymentService::class,
            \App\Services\UserPayment\UserPaymentService::class
        );

        $this->app->bind(
            \App\Services\History\IHistoryService::class,
            \App\Services\History\HistoryService::class
        );

        $this->app->bind(
            \App\Services\Watched\IWatchedService::class,
            \App\Services\Watched\WatchedService::class
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

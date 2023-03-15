<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Web\QuestionController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ContinentController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\CountryTopicController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HistoryPaymentController;
use App\Http\Controllers\Web\InformationController;
use App\Http\Controllers\Web\LevelController;
use App\Http\Controllers\Web\PackageController;
use App\Http\Controllers\Web\TopicController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginGet'])->name('web.login.get');
Route::post('/login', [AuthController::class, 'loginPost'])->name('web.login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('web.logout');

Route::middleware(['auth', 'role'])->group(
    function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('web.dashboard');

        Route::group(['prefix' => 'continents'], function () {

            Route::get('/', [ContinentController::class, 'index'])->name('web.continents');

            Route::middleware('idInteger')->group(function () {
                Route::get('/{id}/edit', [ContinentController::class, 'edit'])->name('web.continents.edit');
                Route::put('/{id}/update', [ContinentController::class, 'update'])->name('web.continents.update');
            });
        });

        Route::group(['prefix' => '/information'], function () {
            Route::get('/', [InformationController::class, 'index'])->name('web.information');
            Route::get('/create', [InformationController::class, 'create'])->name('web.information.create');
            Route::post('/store', [InformationController::class, 'store'])->name('web.information.store');

            Route::middleware('idInteger')->group(function () {
                Route::put('/{id}/send-notification', [NotificationController::class, 'sendNotification'])->name('web.information.send-notification');
                Route::get('/{id}/edit', [InformationController::class, 'edit'])->name('web.information.edit');
                Route::put('/{id}/update', [InformationController::class, 'update'])->name('web.information.update');
                Route::delete('/{id}', [InformationController::class, 'delete'])->name('web.information.delete');
            });
        });

        Route::middleware('idInteger')->group(function () {
            Route::get('/topics/{id}', [TopicController::class, 'edit'])->name('web.topics.edit');
            Route::put('/topics/{id}', [TopicController::class, 'update'])->name('web.topics.update');
            Route::delete('topics/{id}', [TopicController::class, 'delete'])->name('web.topics.delete');
        });

        Route::get('/countries', [CountryController::class, 'index'])->name('web.countries');
        Route::group(
            [
                'prefix' => 'countries',
                'middleware' => 'idInteger'
            ],
            function () {
                Route::get('/{id}', [CountryController::class, 'edit'])->name('web.countries.edit');
                Route::put('/{id}', [CountryController::class, 'update'])->name('web.countries.update');
                Route::get('/{id}/topics', [CountryTopicController::class, 'index'])->name('web.countries-topics');
                Route::post('/{id}/topics', [CountryTopicController::class, 'storeTopic'])->name('web.countries-topics.store');
                Route::get('/{id}/questions', [QuestionController::class, 'index'])->name('web.questions');
                Route::get('/{id}/levels', [LevelController::class, 'indexCountriesGameLevels'])->name('web.countries.levels');
            }
        );

        Route::group(['prefix' => '/users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('web.users');
            Route::middleware('idInteger')->group(function () {
                Route::delete('/{id}', [UserController::class, 'delete'])->name('web.users.delete');
                Route::put('/{id}', [UserController::class, 'updateStatus'])->name('web.users.update-status');
            });
        });

        Route::group(['prefix' => 'topics'], function () {
            Route::get('/', [TopicController::class, 'index'])->name('web.topics');
            Route::get('/create', [TopicController::class, 'create'])->name('web.topics.create');
            Route::post('/store', [TopicController::class, 'store'])->name('web.topics.store');
        });


        Route::group(['prefix' => 'countries-topics', 'middleware' => 'idInteger'], function () {
            Route::delete('/{id}/delete', [CountryTopicController::class, 'delete'])->name('web.countries-topics.delete');
            Route::get('/{id}/videos', [VideoController::class, 'index'])->name('web.countries-topics.videos');
        });


        Route::group(['prefix' => 'videos'], function () {
            Route::get('/create', [VideoController::class, 'create'])->name('web.videos.create');
            Route::post('/store', [VideoController::class, 'store'])->name('web.videos.store');
            Route::post('/upload', [VideoController::class, 'uploadVideo'])->name('web.videos.upload');

            Route::middleware('idInteger')->group(function () {
                Route::get('/{id}/edit', [VideoController::class, 'edit'])->name('web.videos.edit');
                Route::put('/{id}/update', [VideoController::class, 'update'])->name('web.videos.update');
                Route::get('/{id}/reviews', [QuestionController::class, 'indexReview'])->name('web.reviews');
                Route::delete('/{id}', [VideoController::class, 'delete'])->name('web.videos.delete');
            });
        });

        Route::group(['prefix' => 'levels'], function () {
            Route::get('/', [LevelController::class, 'index'])->name('web.levels');
            Route::get('/create', [LevelController::class, 'create'])->name('web.levels.create');
            Route::post('/store', [LevelController::class, 'store'])->name('web.levels.store');

            Route::middleware('idInteger')->group(function () {
                Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('web.levels.edit');
                Route::put('/{id}/update', [LevelController::class, 'update'])->name('web.levels.update');
                Route::delete('/{id}', [LevelController::class, 'delete'])->name('web.levels.delete');
            });
        });

        Route::group(['prefix' => 'questions'], function () {
            Route::get('/create', [QuestionController::class, 'create'])->name('web.questions.create');
            Route::post('/store', [QuestionController::class, 'store'])->name('web.questions.store');

            Route::middleware('idInteger')->group(function () {
                Route::get('/{id}/edit', [QuestionController::class, 'edit'])->name('web.questions.edit');
                Route::put('/{id}/update', [QuestionController::class, 'update'])->name('web.questions.update');
                Route::delete('/{id}', [QuestionController::class, 'delete'])->name('web.questions.delete');
            });
        });

        Route::get('/services', [PackageController::class, 'index'])->name('web.services');
        Route::group(['prefix' => 'services', 'middleware' => 'idInteger'], function () {
            Route::get('/{id}/edit', [PackageController::class, 'edit'])->name('web.services.edit');
            Route::put('/{id}', [PackageController::class, 'update'])->name('web.services.update');
        });

        Route::get('/users-payment', [HistoryPaymentController::class, 'index'])->name('web.users-payment');
        Route::get('/test-payment', [PaymentController::class, 'getUrlPaymentTest']);
        Route::get('/home', [NotificationController::class, 'index'])->name('notify-home');
        Route::post('/save-token', [NotificationController::class, 'saveToken'])->name('save-token');
    }
);

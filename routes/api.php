<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ContinentController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ErrorController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth:api', 'blocked'])->group(function () {

    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [UserController::class, 'getProfile']);
        Route::put('/', [UserController::class, 'update']);
        Route::patch('/', [UserController::class, 'update']);
    });

    Route::middleware(['expiredTrial'])->group(function () {
        Route::get('/countries', [CountryController::class, 'index']);
        Route::get('/continents', [ContinentController::class, 'index']);

        Route::middleware(['idInteger'])->group(function () {
            Route::get('/continents/{id}', [ContinentController::class, 'getCountries']);
            Route::get('/countries/{id}/topics', [TopicController::class, 'index']);
            Route::get('/countries-topics/{id}/videos', [VideoController::class, 'index']);

            Route::get('/videos/{id}/questions', [QuestionController::class, 'index']);

            Route::get('/countries/{id}/questions', [QuestionController::class, 'getQuestionsInACountry']);
            Route::post('/countries/{id}/history-play-game', [HistoryController::class, 'storeUserPlayGame']);

            Route::post('/videos/{id}/store-history', [HistoryController::class, 'storeUserWatched']);
        });

        Route::group(['prefix' => 'information'], function () {
            Route::get('/', [InformationController::class, 'index']);
            Route::post('/', [InformationController::class, 'create']);
        });

        Route::get('/levels', [LevelController::class, 'index']);

        Route::get('/watched-history', [HistoryController::class, 'getWatchedVideos']);

        Route::post('/save-token', [NotificationController::class, 'saveToken']);
    });

    Route::get('/payment', [PaymentController::class, 'getUrlPayment']);
    Route::get('/services', [PackageController::class, 'index']);
});

Route::get('/IPN', [PaymentController::class, 'checkIsPayMentSuccess']);

Route::group(
    [
        'prefix' => '/errors',
        'as' => 'errors.'
    ],
    function () {
        Route::get('/expired-trial', [ErrorController::class, 'expiredTrial'])->name('expired-trial');
        Route::get('/blocked', [ErrorController::class, 'blocked'])->name('blocked');
    }
);

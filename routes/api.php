<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ContinentController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;
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

Route::get('/continents', [ContinentController::class, 'index']);

Route::middleware(['idInteger'])->group(function () {
    Route::get('/continents/{id}', [ContinentController::class, 'getCountries']);
    Route::get('/countries/{id}/topics', [TopicController::class, 'index']);
    Route::get('/countries-topics/{id}/videos', [VideoController::class, 'index']);

    Route::get('/videos/{id}/questions', [QuestionController::class, 'index']);

    Route::get('/countries/{id}/questions', [QuestionController::class, 'getQuestionsInACountry']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/information', [InformationController::class, 'index']);

Route::post('/information', [InformationController::class, 'create']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/profile', [UserController::class, 'getProfile']);
    Route::put('/profile', [UserController::class, 'update']);
    Route::patch('/profile', [UserController::class, 'update']);
    Route::get('/countries', [CountryController::class, 'index']);
    Route::post('/countries/user-play-game', [CountryController::class, 'storeUserPlayGame']);
    Route::get('/payment', [PaymentController::class, 'getUrlPayment']);
});


Route::get('/services', [PackageController::class, 'index']);

Route::get('/levels', [LevelController::class, 'index']);

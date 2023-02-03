<?php

use App\Http\Controllers\Api\ContinentController;
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
    Route::get('countries-topics/{id}/videos', [VideoController::class, 'index']);
});

Route::get('/profile', [UserController::class, 'getProfile']);

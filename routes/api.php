<?php

use App\Http\Controllers\ContinentController;
use App\Http\Controllers\TopicController;
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
    Route::get('/continent/{id}', [ContinentController::class, 'getCountries']);
    Route::get('/country/{id}/topics', [TopicController::class, 'index']);
});

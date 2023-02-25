<?php

use App\Http\Controllers\Web\QuestionController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ContinentController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\CountryTopicController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\InformationController;
use App\Http\Controllers\Web\LevelController;
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

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginGet'])->name('web.login.get');
Route::post('/login', [AuthController::class, 'loginPost'])->name('web.login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('web.logout');

Route::middleware(['auth', 'role'])->group(
    function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('web.dashboard');
        Route::get('/continents', [ContinentController::class, 'index'])->name('web.continents');
        Route::get('/continents/{id}/edit', [ContinentController::class, 'edit'])->name('web.continents.edit');
        Route::put('/continents/{id}/update', [ContinentController::class, 'update'])->name('web.continents.update');

        Route::get('/countries', [CountryController::class, 'index'])->name('web.countries');

        Route::get('/information', [InformationController::class, 'index'])->name('web.information');

        Route::middleware('idInteger')->group(function () {
            Route::get('/information/{id}/edit', [InformationController::class, 'edit'])->name('web.information.edit');
            Route::put('/information/{id}/update', [InformationController::class, 'update'])->name('web.information.update');

            Route::delete('users/{id}', [UserController::class, 'delete'])->name('web.users.delete');

            Route::get('/countries/{id}', [CountryController::class, 'edit'])->name('web.countries.edit');
            Route::put('/countries/{id}', [CountryController::class, 'update'])->name('web.countries.update');

            Route::get('/topics/{id}', [TopicController::class, 'edit'])->name('web.topics.edit');
            Route::put('/topics/{id}', [TopicController::class, 'update'])->name('web.topics.update');
            Route::delete('topics/{id}', [TopicController::class, 'delete'])->name('web.topics.delete');
        });

        Route::get('/users', [UserController::class, 'index'])->name('web.users');

        Route::get('/topics', [TopicController::class, 'index'])->name('web.topics');
        Route::get('/topic/create', [TopicController::class, 'create'])->name('web.topics.create');
        Route::post('/topic/store', [TopicController::class, 'store'])->name('web.topics.store');

        Route::get('/countries/{id}/topics', [CountryTopicController::class, 'index'])->name('web.countries-topics');
        Route::post('/countries/{id}/topics', [CountryTopicController::class, 'storeTopic'])->name('web.countries-topics.store');
        Route::get('/countries/{id}/questions', [QuestionController::class, 'index'])->name('web.questions');

        Route::get('/countries/{id}/levels', [LevelController::class, 'indexCountriesGameLevels'])->name('web.countries.levels');

        Route::delete('/countries-topics/{id}/delete', [CountryTopicController::class, 'delete'])->name('web.countries-topics.delete');

        Route::get('/countries-topics/{id}/videos', [VideoController::class, 'index'])->name('web.countries-topics.videos');

        Route::get('/videos/{id}/edit', [VideoController::class, 'edit'])->name('web.videos.edit');
        Route::put('/videos/{id}/update', [VideoController::class, 'update'])->name('web.videos.update');
        Route::get('/videos/create', [VideoController::class, 'create'])->name('web.videos.create');
        Route::post('/videos/store', [VideoController::class, 'store'])->name('web.videos.store');

        Route::post('/videos/upload', [VideoController::class, 'uploadVideo'])->name('web.videos.upload');

        Route::get('/levels', [LevelController::class, 'index'])->name('web.levels');
        Route::get('/levels/create', [LevelController::class, 'create'])->name('web.levels.create');
        Route::get('/levels/{id}/edit', [LevelController::class, 'edit'])->name('web.levels.edit');
        Route::put('/levels/{id}/update', [LevelController::class, 'update'])->name('web.levels.update');
        Route::post('/levels/store', [LevelController::class, 'store'])->name('web.levels.store');
        Route::delete('/levels/{id}', [LevelController::class, 'delete'])->name('web.levels.delete');

        Route::get('/questions/create', [QuestionController::class, 'create'])->name('web.questions.create');
        Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('web.questions.edit');
        Route::put('/questions/{id}/update', [QuestionController::class, 'update'])->name('web.questions.update');
    }
);

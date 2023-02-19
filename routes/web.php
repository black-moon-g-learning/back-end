<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ContinentController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\InformationController;
use App\Http\Controllers\Web\TopicController;
use App\Http\Controllers\Web\UserController;
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

Route::group(['prefix' => 'admin'], function () {

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
            });

            Route::get('/users', [UserController::class, 'index'])->name('web.users');

            Route::get('/topics', [TopicController::class, 'index'])->name('web.topics');
        }
    );
});

<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ContinentController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\InformationController;
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
    return view('pages.dashboard');
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

        Route::get('/information', [InformationController::class, 'index'])->name('web.information');
    }
);

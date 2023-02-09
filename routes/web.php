<?php

use App\Http\Controllers\Web\AuthController;
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

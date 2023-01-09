<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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

Route::get('/', [MainController::class, 'index'])
    ->name('home');

Route::group(
    ['prefix' => '/sing-up'],
    function () {
        Route::get('', [UserController::class, 'singUpForm'])
            ->name('sing-up');

        Route::get('/code', [UserController::class, 'singUpCodeForm'])
            ->name('sing-up.code');
    }
);

Route::group(
    ['prefix' => '/login'],
    function (){
        Route::get('', [LoginController::class, 'loginForm'])
            ->name('login');
        Route::post('', [LoginController::class, 'loginIn'])
            ->name('login-in');
    }
);

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

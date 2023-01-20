<?php

use App\Http\Controllers\CodeController;
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
Route::get('/admin_panel', [MainController::class, 'adminPage'])
    ->name('admin');

Route::group(
    ['prefix' => '/sing-in'],
    function () {
        Route::get('', [UserController::class, 'singInForm'])
            ->name('sing-in.form');
        Route::post('', [UserController::class, 'singIn'])
            ->name('sing-in');

        Route::get('/code', [CodeController::class, 'singUpCodeForm'])
            ->name('sing-up.codeForm');
        Route::post('/code', [CodeController::class, 'singUpCode'])
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


<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInfoController;
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

Route::get('/lessons', [MainController::class, 'lessons'])
    ->name('lessons');

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

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::group(
    ['prefix' => '/discipline'],
    function (){
        Route::get('', [DisciplineController::class, 'list'])
            ->name('discipline.list');

        Route::get('/create', [DisciplineController::class, 'createForm'])
            ->name('discipline.createForm');
        Route::post('/create', [DisciplineController::class, 'create'])
            ->name('discipline.create');

        Route::group(['prefix' => '/{discipline}/edit'], function () {
            Route::get('', [DisciplineController::class, 'editForm'])
                ->name('discipline.editForm');

            Route::post('', [DisciplineController::class, 'edit'])
                ->name('discipline.edit');
        });

        Route::post('/{discipline}/delete', [DisciplineController::class, 'delete'])
            ->name('discipline.delete');
    }
);

Route::group(
    ['prefix' => '/class'],
    function (){
        Route::get('', [SchoolClassController::class, 'list'])
            ->name('schClass.list');

        Route::get('/create', [SchoolClassController::class, 'createForm'])
            ->name('schClass.createForm');
        Route::post('/create', [SchoolClassController::class, 'create'])
            ->name('schClass.create');

        Route::group(['prefix' => '/{schoolClass}/edit'], function () {
            Route::get('', [SchoolClassController::class, 'editForm'])
                ->name('schClass.editForm');

            Route::post('', [SchoolClassController::class, 'edit'])
                ->name('schClass.edit');
        });

        Route::post('/{schoolClass}/delete', [SchoolClassController::class, 'delete'])
            ->name('schClass.delete');
    }
);

Route::group(
    ['prefix' => '/users'],
        function(){
        Route::get('', [UserInfoController::class, 'list'])
            ->name('userInfo.list');

        Route::group(['prefix' =>'/create'], function (){
            Route::get('', [UserInfoController::class, 'createForm'])
            ->name('users.createForm');

            Route::post('', [UserInfoController::class, 'create'])
                ->name('users.create');
        });

        Route::group(['prefix' => '/{userInfo}/edit'], function (){
            Route::get('', [UserInfoController::class, 'editForm'])
                ->name('users.editForm');

            Route::post('', [UserInfoController::class, 'edit'])
                ->name('users.edit');
        });

            Route::post('/{userInfo}/delete', [UserInfoController::class, 'delete'])
                ->name('users.delete');

            Route::get('/{userInfo}/show', [UserInfoController::class, 'show'])
                ->name('users.show');

        });

Route::group(
    ['prefix'=> '/schedule'],
    function (){
        Route::get('/', [ScheduleController::class, 'list'])
            ->name('schedule.list');
    });

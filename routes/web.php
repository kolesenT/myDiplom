<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\JournalController;
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
    ->name('welcome');
Route::get('/home', [MainController::class, 'adminPage'])
    ->name('home');

Route::get('/lessons', [MainController::class, 'lessons'])
    ->name('lessons');

Route::group(
    ['prefix' => '/sing-in'],
    function () {
        Route::get('/', [UserController::class, 'singInForm'])
            ->name('sing-in.form');
        Route::post('/', [UserController::class, 'singIn'])
            ->name('sing-in');

        Route::get('/code', [CodeController::class, 'singUpCodeForm'])
            ->name('sing-up.codeForm');
        Route::post('/code', [CodeController::class, 'singUpCode'])
            ->name('sing-up.code');
    }
);

Route::group(
    ['prefix' => '/login'],
    function () {
        Route::get('', [LoginController::class, 'loginForm'])
            ->name('login');
        Route::post('', [LoginController::class, 'loginIn'])
            ->name('login-in');
    }
);

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::group(
    ['prefix' => '/discipline', 'middleware' => 'auth'],
    function () {
        Route::get('', [DisciplineController::class, 'list'])
            ->name('discipline.list');

        Route::group(['prefix' => '/create', 'middleware' => 'can:create,\App\Discipline'], function () {
            Route::get('', [DisciplineController::class, 'createForm'])
                ->name('discipline.createForm');
            Route::post('', [DisciplineController::class, 'create'])
                ->name('discipline.create');
        });

        Route::group(['prefix' => '/{discipline}/edit', 'middleware' => 'can:update,discipline'], function () {
            Route::get('', [DisciplineController::class, 'editForm'])
                ->name('discipline.editForm');

            Route::post('', [DisciplineController::class, 'edit'])
                ->name('discipline.edit');
        });

        Route::post('/{discipline}/delete', [DisciplineController::class, 'delete'])
            ->name('discipline.delete')->middleware('can:delete,discipline');
    }
);

Route::group(
    ['prefix' => '/class', 'middleware' => 'auth'],
    function () {
        Route::get('', [SchoolClassController::class, 'list'])
            ->name('schClass.list');

        Route::group(['prefix' => '/create', 'middleware' => 'can:create,\App\SchoolClass'], function () {
            Route::get('', [SchoolClassController::class, 'createForm'])
                ->name('schClass.createForm');
            Route::post('', [SchoolClassController::class, 'create'])
                ->name('schClass.create');
        });

        Route::group(['prefix' => '/{schoolClass}/edit', 'middleware' => 'can:update,schoolClass'], function () {
            Route::get('', [SchoolClassController::class, 'editForm'])
                ->name('schClass.editForm');

            Route::post('', [SchoolClassController::class, 'edit'])
                ->name('schClass.edit');
        });

        Route::post('/{schoolClass}/delete', [SchoolClassController::class, 'delete'])
            ->name('schClass.delete')->middleware('can:delete,schoolClass');

        Route::get('/{schoolClass}/show', [SchoolClassController::class, 'show'])
            ->name('schClass.show')->middleware('can:view,schoolClass');

        Route::group(['prefix' => '/{schoolClass}/addUsers'], function () {
            Route::get('', [SchoolClassController::class, 'addUsersForm'])
                ->name('schClass.addUsersForm');

            Route::post('', [SchoolClassController::class, 'addUsers'])
                ->name('schClass.addUsers');
        });
    }
);

Route::group(
    ['prefix' => '/users', 'middleware' => 'auth'],
    function () {
        Route::get('', [UserInfoController::class, 'list'])
            ->name('userInfo.list');

        Route::group(['prefix' => '/create', 'middleware' => 'can:create,\App\User_info'], function () {
            Route::get('', [UserInfoController::class, 'createForm'])
                ->name('users.createForm');

            Route::post('', [UserInfoController::class, 'create'])
                ->name('users.create');
        });

        Route::group(['prefix' => '/{userInfo}/edit', 'middleware' => 'can:update,userInfo'], function () {
            Route::get('', [UserInfoController::class, 'editForm'])
                ->name('users.editForm');

            Route::post('', [UserInfoController::class, 'edit'])
                ->name('users.edit');
        });

        Route::post('/{userInfo}/delete', [UserInfoController::class, 'delete'])
            ->name('users.delete')->middleware('can:delete,userInfo');

        Route::get('/{userInfo}/show', [UserInfoController::class, 'show'])
            ->name('users.show')->middleware('can:view,userInfo');

    });

Route::group(
    ['prefix' => '/schedule', 'middleware' => 'auth'],
    function () {
        Route::get('/{schoolClass}', [ScheduleController::class, 'list'])
            ->name('schedule.list');

        Route::group(['prefix' => '/create', 'middleware' => 'can:create,\App\SchoolClass'], function () {
            Route::get('/{schoolClass}', [ScheduleController::class, 'createForm'])
                ->name('schedule.createForm');

            Route::post('', [ScheduleController::class, 'create'])
                ->name('schedule.create');
        });
    });

Route::group(['prefix' => '/journal', 'middleware' => 'auth'],
    function () {
        Route::get('/{schoolClass}', [JournalController::class, 'show'])
            ->name('journal.show')->middleware('can:view,schoolClass');
    });

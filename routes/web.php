<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
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

Route::middleware("guest")->group(function() {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login_process', [AuthController::class, 'loginProcess'])->name('login_process');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register_process', [AuthController::class, 'registerProcess'])->name('register_process');
});

Route::middleware("auth")->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/destroy/{id}', [AuthController::class, 'destroy'])->name('destroy');

    Route::resource('city', CityController::class);
    Route::get('/application/join', [ApplicationController::class, 'joinForm'])->name('application.joinForm');
    Route::post('/application/joinProcess', [ApplicationController::class, 'joinProcess'])->name('application.joinProcess');
    Route::get('/application/decline/{application}', [ApplicationController::class, 'decline'])->name('application.decline');
    Route::resource('/application', ApplicationController::class)->only([
        'index', 'create', 'store', 'destroy',
    ]);
    Route::get('/user/userApps', [UserController::class, 'userApps'])->name('user.userApps');
    Route::get('/user/makeAdmin/{user}', [UserController::class, 'makeAdmin'])->name('user.makeAdmin');
    Route::resource('/user', UserController::class)->only(['index', 'destroy']);
});

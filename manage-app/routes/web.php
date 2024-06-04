<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
                               
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');

        // users routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');

    });
});
Route::group(['prefix' => '/'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('loginPost');
        Route::get('/logout', 'logout')->name('logout');
    });
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/attendance', 'index')->name('showTimeCard');
        Route::post('/attendance', 'add')->name('addTimeCard');
    });

});
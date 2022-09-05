<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/send-password-reset-email', [AuthController::class, 'sendPasswordResetEmail'])->name('send-email');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/users', UserController::class)->except(['create', 'store']);
    Route::resource('/forms', FormController::class)->only(['index', 'store', 'destroy']);
    Route::get('/list-forms', [FormController::class, 'getListFormsBelongUser']);
    Route::patch('/change-status-form/{form}', [FormController::class, 'changeStatusByAdmin']);
    Route::patch('/change-information-form/{form}', [FormController::class, 'changeInfoOnlyEmployee']);
});

Route::get('/home', [HomeController::class, 'index']);

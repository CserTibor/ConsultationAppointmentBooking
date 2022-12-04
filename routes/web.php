<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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


Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'show']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/users/appointments', [AppointmentController::class, 'myAppointments']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointments/create', [AppointmentController::class, 'create']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::post('/appointments/{id}/seize', [AppointmentController::class, 'seize']);
    Route::post('/appointments/{id}/delete', [AppointmentController::class, 'delete']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/me', [UserController::class, 'me']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::post('/users/{id}/roles', [UserController::class, 'addRole']);
});



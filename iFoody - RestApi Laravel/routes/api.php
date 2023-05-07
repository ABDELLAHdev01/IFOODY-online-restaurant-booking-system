<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResturantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(ResturantController::class)->group(function () {
    Route::get('resturants', 'index');
    // Route::get('resturants/{resturant}', 'show');
    // Route::post('resturants', 'store');
    // Route::put('resturants/{resturant}', 'update');
    // Route::delete('resturants/{resturant}', 'destroy');
});
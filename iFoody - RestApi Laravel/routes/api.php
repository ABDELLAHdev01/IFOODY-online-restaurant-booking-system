<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResturantController;
// roles namespace



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
    // user could see all resturants without login
    Route::get('resturants', 'index');
    Route::post('resturant', 'show');
    Route::post('apply', 'applyresturant');

    // admin could add, update, delete resturants
    Route::post('addresturants', 'store');
    Route::post('resturant/{id}', 'update');
    Route::post('resturants', 'destroy');
    Route::post('resturant/{id}/approve', 'approve');



//

});
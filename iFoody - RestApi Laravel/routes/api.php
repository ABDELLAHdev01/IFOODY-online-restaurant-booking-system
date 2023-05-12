<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MangerController;
use App\Http\Controllers\ResturantController;
use App\Http\Controllers\UserController;

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

Route::controller(UserController::class)->group(function () {
     // user could see all resturants without login
    Route::get('resturants', 'index');
    Route::post('resturant', 'show');
    Route::post('apply', 'applyresturant');
    Route::post('bookTable', 'bookTable');
});

Route::controller(AdminController::class)->group(function () {

Route::group(['middleware' => ['role:admin']], function () {
    Route::post('addresturants', 'store');
    Route::post('resturant/{id}', 'update');
    Route::post('resturants', 'destroy');
    Route::post('resturant/{id}/approve', 'approve');
});

});

Route::controller(MangerController::class)->group(function () {

     Route::group(['middleware' => ['role:manager']], function () {

        Route::get('manger/resturant', 'index');
        Route::post('manger/update', 'update');
        Route::post('manger/addtable', 'addTabels');
        Route::post('manger/updateTable', 'updateTabels');
        Route::post('manger/deleteTable', 'removeTable');

    });

});
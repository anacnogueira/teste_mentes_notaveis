<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAddressController;

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

Route::apiResource('users', UserController::class);
Route::apiResource('users.addresses', UserAddressController::class);
Route::get('/states/users-by-state', [StateController::class, 'usersByState']);
Route::apiResource('states', StateController::class);
Route::get('/cities/users-by-city', [CityController::class, 'usersByCity']);
Route::apiResource('cities', CityController::class);




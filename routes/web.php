<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth;

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

Route::post('login', [Auth\UserController::class, 'login']);

Route::post('logout', [Auth\UserController::class, 'logout']);

Route::view('{uri?}/{uri2?}', 'spa');
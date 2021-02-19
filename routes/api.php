<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth;
use App\Http\Controllers\API;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
	Route::get('check', [Auth\UserController::class, 'check']);
	Route::get('preload', [Auth\UserController::class, 'permissions']);
	Route::post('change-password', [Auth\UserController::class, 'changePassword']);

	Route::prefix('account')->group(function () {
		Route::prefix('user')->group(function () {
			Route::get('/', [API\AccountController::class, 'getUser']);
			Route::post('/', [API\AccountController::class, 'postUser']);
			Route::patch('{role}', [API\AccountController::class, 'patchUser']);
		});
		Route::prefix('role')->group(function () {
			Route::get('/', [API\AccountController::class, 'getRole']);
			Route::post('/', [API\AccountController::class, 'postRole']);
			Route::patch('{role}', [API\AccountController::class, 'patchRole']);
			Route::delete('{role}', [API\AccountController::class, 'deleteRole']);
		});
		Route::get('permission', [API\AccountController::class, 'getPermission']);
	});
});

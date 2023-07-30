<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EndorsementsController;
use App\Http\Controllers\OpeningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::apiResource('/users', RegisteredUserController::class);
    Route::apiResource('/auth/user', AuthenticatedSessionController::class);
})->middleware('api');
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {
    Route::apiResource('/endorsements', EndorsementsController::class);
    Route::apiResource('/log-books', LogBookController::class);
    Route::apiResource('/applications', ApplicationController::class);
    Route::apiResource('/openings', OpeningController::class);
})->middleware('api');

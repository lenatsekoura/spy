<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpyController;
use App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/spies', [SpyController::class, 'store']);
});
Route::middleware(['throttle:10,1'])->group(function () {
    Route::get('/spies-random', [SpyController::class, 'getSpiesRandom']);
});
Route::get('/spies-list', [SpyController::class, 'getSpies']);
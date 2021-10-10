<?php

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


Route::get('/ping', [\App\Http\Controllers\PingPongController::class, 'ping']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], static function ($router) {
    Route::post('/', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});


Route::group([
    'middleware' => 'auth.custom',
    'prefix' => 'book'
], static function ($router) {
    Route::get('/{name}', [\App\Http\Controllers\BookController::class, 'findByName']);
    Route::post('/', [\App\Http\Controllers\BookController::class, 'store']);
});

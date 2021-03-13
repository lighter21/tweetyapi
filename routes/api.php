<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->prefix('tweets')->group(function () {
    Route::get('', [TweetController::class, 'index']);
    Route::post('/add', [TweetController::class, 'store']);
    Route::delete('/{id}/delete', [TweetController::class, 'destroy']);
    Route::put('/{id}/update', [TweetController::class, 'update']);
});

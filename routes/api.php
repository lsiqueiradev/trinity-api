<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


Route::post('sessions/validate', [AuthController::class, 'sessionsValidate']);
Route::post('sessions/provider', [AuthController::class, 'sessionsProvider']);
Route::post('sessions', [AuthController::class, 'sessions']);
Route::post('register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

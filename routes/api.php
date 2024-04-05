<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ResetLinkPasswordController;
use App\Http\Controllers\Api\UserController;

Route::post('sessions/validate', [AuthController::class, 'sessionsValidate']);
Route::post('sessions/provider', [AuthController::class, 'sessionsProvider']);
Route::post('sessions', [AuthController::class, 'sessions']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot-password', [ResetLinkPasswordController::class, 'store']);

Route::group(['middleware' => 'auth:api'], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [UserController::class, 'me']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
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

    // users
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'edit']);
    Route::post('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'delete']);

    // profile
    Route::get('me', [ProfileController::class, 'index']);

});

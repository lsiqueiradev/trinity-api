<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('changed-password', [NewPasswordController::class, 'index'])->name('password.changed');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');

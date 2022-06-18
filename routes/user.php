<?php

use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['guest'])->group(function () {
    Route::get('login', [User\LoginController::class, 'index'])->name('user.login');
    Route::post('login', [User\LoginController::class, 'login']);
    Route::get('google', [GoogleAuthController::class, 'redirect'])->name('user.google');
});

Route::middleware(['check_auth:user'])->group(function () {
    Route::get('/', function() {
        return redirect()->route('user.home');
    });
    Route::get('home', [User\HomeController::class, 'index'])->name('user.home');

    Route::post('/logout', [User\LoginController::class, 'logout'])
                ->name('user.logout');
});

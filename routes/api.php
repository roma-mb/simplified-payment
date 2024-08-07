<?php

declare(strict_types=1);

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransferController;
use App\Http\Middleware\JWTAuth;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/login/verify', [LoginController::class, 'verify'])->name('auth.verify');

Route::middleware(JWTAuth::class)->group(function () {
    Route::post('/transfer', [TransferController::class, 'transfer']);
});

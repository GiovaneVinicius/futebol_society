<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MatchController;
use App\Http\Middleware\CheckSanctumToken;

// Rotas para registro, login e logout de usuários
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(CheckSanctumToken::class)->group(function () {
    // JOGADORES
    Route::resource('players', PlayerController::class);
    Route::resource('matches', MatchController::class);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\{UserController};
use App\Http\Controllers\Api\Auth\{AuthController};


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);

  Route::get('/me', [UserController::class, 'me']);
  Route::apiResource('/users', UserController::class);
});
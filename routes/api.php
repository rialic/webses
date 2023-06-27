<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\{UserCnesController, UserController};
use App\Http\Controllers\Api\Auth\{AuthController, RegisterController};


Route::get('datacnes-user', [UserCnesController::class, 'index']);

Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/me', [AuthController::class, 'me']);
  Route::post('/logout', [AuthController::class, 'logout']);

  Route::apiResource('/users', UserController::class);
});
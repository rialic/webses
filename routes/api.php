<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\{UserCnesController, UserController};
use App\Http\Controllers\Api\Auth\{AuthController, RegisterController};
use App\Http\Controllers\Api\State\{StateController};
use App\Http\Controllers\Api\City\{CityController};
use App\Http\Controllers\Api\Establishment\{EstablishmentController};
use App\Http\Controllers\Api\Cbo\{CBOController};

Route::get('datacnes-user', [UserCnesController::class, 'index']);
Route::get('states', [StateController::class, 'index']);
Route::get('cities', [CityController::class, 'index']);
Route::get('establishments', [EstablishmentController::class, 'index']);
Route::get('cbo', [CBOController::class, 'index']);

// Route::post('/auth', [AuthController::class, 'auth']);
// Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);

  Route::get('/me', [UserController::class, 'me']);
  Route::apiResource('/users', UserController::class);
});
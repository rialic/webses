<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Event\{EventController, EventParticipantController};
use App\Http\Controllers\Api\Module\{ModuleController};
use App\Http\Controllers\Api\User\{UserController};
use App\Http\Controllers\Api\Auth\{AuthController};


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);

  Route::apiResource('/users', UserController::class);
  Route::get('/me', [UserController::class, 'me']);

  Route::apiResource('/modules', ModuleController::class)->only(['index']);
  Route::apiResource('/events', EventController::class);
  Route::apiResource('/event-participants', EventParticipantController::class)->only(['index', 'store']);
});
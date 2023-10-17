<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\{ResentEmailVerificationController};
use App\Http\Controllers\Api\User\{UserCnesController};
use App\Http\Controllers\Api\State\{StateController};
use App\Http\Controllers\Api\City\{CityController};
use App\Http\Controllers\Api\Establishment\{EstablishmentController};
use App\Http\Controllers\Api\Cbo\{CBOController};

Route::get('datacnes-user', [UserCnesController::class, 'index']);

Route::get('states', [StateController::class, 'index']);
Route::get('cities', [CityController::class, 'index']);
Route::get('establishments', [EstablishmentController::class, 'index']);
Route::get('cbo', [CBOController::class, 'index']);
Route::post('resent-email-verification', [ResentEmailVerificationController::class, 'resentEmailVerification']);
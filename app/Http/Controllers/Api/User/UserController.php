<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Service\User\UserService;
use Illuminate\Http\Request;
use App\Traits\HasResourceController;

class UserController extends Controller
{
  use HasResourceController;

  private $service;
  private $resourceColection;

  public function __construct(UserService $service)
  {
    $this->service = $service;
    $this->resourceColection = UserResource::class;
  }

  public function me(Request $request)
  {
    return new $this->resourceColection($request->user());
  }
}

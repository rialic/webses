<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Http\Requests\User\StoreUpdateUser;

class UserController extends Controller
{
  private $model;

  public function __construct(User $user)
  {
    $this->model = $user;
  }

  public function index()
  {
    $users = User::get();
    return UserResource::collection($users);
  }

  public function update(StoreUpdateUser $request, $identify)
  {
    $user = $this->model->where('us_uuid', $identify)->firstOrFail();

    $data = $request->validated();

    if ($request->password) {
      $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    return response()->json(['updated' => 'success']);
  }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUpdateUser;
use App\Http\Resources\User\UserResource;

use App\Models\User;

class RegisterController extends Controller
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(StoreUpdateUser $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $this->model->fill($this->model->syncFields($data))->save();

        return (new UserResource($this->model))->additional(['token' => $this->model->createToken($request->device_name)->plainTextToken]);
    }
}

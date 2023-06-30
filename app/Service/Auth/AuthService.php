<?php

namespace App\Service\Auth;

use App\Http\Requests\User\AuthUser;
use App\Repository\Interfaces\UserInterface as UserRepository;
use App\Service\Base\ResourceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService extends ResourceService
{
  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  public function validatorRequest()
  {
    return app(AuthUser::class);
  }

  public function auth()
  {
    $filters = parseFilters(request()->only('email'));
    $user = $this->repository->getFirstData($filters);

    if (!$user || !Hash::check(request()->password, $user->password)) {
      throw ValidationException::withMessages(['email' => 'Email ou senha incorretos.']);
    }

    return $user;
  }

  public function logout()
  {
    request()->user()->tokens()->delete();
  }
}

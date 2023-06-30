<?php

namespace App\Service\Auth;

use App\Http\Requests\User\StoreUpdateUser;
use App\Repository\Interfaces\UserInterface as UserRepository;
use App\Service\Base\ResourceService;

class RegisterService extends ResourceService
{
  protected $storeInputs = [
    'name',
    'cpf',
    'email',
    'password',
    'device_name'
  ];

  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  public function validatorRequest()
  {
    return app(StoreUpdateUser::class);
  }
}

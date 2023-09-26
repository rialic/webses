<?php

namespace App\Service\User;

use App\Http\Requests\User\StoreUpdateUser;
use App\Repository\Interfaces\UserInterface as UserRepository;
use App\Service\Base\ServiceResource;

class UserService extends ServiceResource
{
  protected $storeInputs = [
    'name',
    'cpf',
    'email',
    'password',
    'device_name'
  ];

  protected $updateInputs = [
    'name',
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

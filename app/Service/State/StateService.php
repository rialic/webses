<?php

namespace App\Service\State;

use App\Repository\Interfaces\StateInterface as StateRepository;
use App\Service\Base\ServiceResource;

class StateService extends ServiceResource
{
  public function __construct(StateRepository $repository)
  {
    $this->repository = $repository;
  }
}

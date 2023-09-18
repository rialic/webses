<?php

namespace App\Service\Cbo;

use App\Repository\Interfaces\CBOInterface as CBORepository;
use App\Service\Base\ServiceResource;

class CBOService extends ServiceResource
{
  public function __construct(CBORepository $repository)
  {
    $this->repository = $repository;
  }
}

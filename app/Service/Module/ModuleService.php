<?php

namespace App\Service\Module;

use App\Repository\Interfaces\ModuleInterface as ModuleRepository;
use App\Service\Base\ServiceResource;

class ModuleService extends ServiceResource
{
  public function __construct(ModuleRepository $repository)
  {
    $this->repository = $repository;
  }
}

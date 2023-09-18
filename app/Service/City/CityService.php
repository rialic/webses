<?php

namespace App\Service\City;

use App\Repository\Interfaces\CityInterface as CityRepository;
use App\Service\Base\ServiceResource;

class CityService extends ServiceResource
{
  public function __construct(CityRepository $repository)
  {
    $this->repository = $repository;
  }
}

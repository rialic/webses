<?php

namespace App\Service\Establishment;

use App\Repository\Interfaces\EstablishmentInterface as EstablishmentRepository;
use App\Service\Base\ServiceResource;

class EstablishmentService extends ServiceResource
{
  public function __construct(EstablishmentRepository $repository)
  {
    $this->repository = $repository;
  }
}

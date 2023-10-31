<?php

namespace App\Service\Event;

use App\Repository\Interfaces\EventParticipantInterface as EventParticipantRepository;
use App\Service\Base\ServiceResource;

class EventParticipantService extends ServiceResource
{
  protected $storeInputs = [
    'event_uuid',
    'user_uuid'
  ];

  public function __construct(EventParticipantRepository $repository)
  {
    $this->repository = $repository;
  }
}

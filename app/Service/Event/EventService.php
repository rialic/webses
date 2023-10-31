<?php

namespace App\Service\Event;

use App\Repository\Interfaces\EventInterface as EventRepository;
use App\Service\Base\ServiceResource;
use Illuminate\Support\Facades\Log;

class EventService extends ServiceResource
{
  public function __construct(EventRepository $repository)
  {
    $this->repository = $repository;
  }

  public function index()
  {
    $params = $this->getParams();

    if (isset($params['filter:events_availables'])) {
      $eventList = parent::index();
      $hasEventList = $eventList->isNotEmpty();

      if ($hasEventList) {
        $eventList = $eventList->filter(function ($event, $key) {
          $startMinutesAdditions = $event->start_minutes_additions;
          $endMinutesAdditions = $event->end_minutes_additions;

          $dateStartEvent = strtotime($event->start_at);
          $dateStartEvent = date('Y-m-d H:i:s', ($dateStartEvent - ($startMinutesAdditions * 60)));

          $dateEndEvent = strtotime($event->end_at);
          $dateEndEvent = date('Y-m-d H:i:s', ($dateEndEvent + ($endMinutesAdditions * 60)));

          if (($dateStartEvent <= date('Y-m-d H:i:s')) && ($dateEndEvent >= date('Y-m-d H:i:s'))) {
            return $event;
          }
        });
      }

      return $eventList;
    }

    return parent::index();
  }
}

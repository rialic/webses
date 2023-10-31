<?php

namespace App\Repository;

use App\Models\Event;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\EventInterface;

class EventRepository extends DBRepository implements EventInterface
{
    protected function model()
    {
        return Event::class;
    }

    public function filterByEventsAvailables($query, $data, $field)
    {
        return $query->whereRaw('date(ev_start_at) = curdate()');
    }
}
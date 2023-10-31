<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Traits\HasResourceController;
use App\Http\Resources\Event\EventResource;
use App\Service\Event\EventService;

class EventController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(EventService $service)
    {
        $this->service = $service;
        $this->resourceColection = EventResource::class;
    }
}

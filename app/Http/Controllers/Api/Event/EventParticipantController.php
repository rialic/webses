<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use App\Traits\HasResourceController;
use App\Http\Resources\Event\EventParticipantResource;
use App\Service\Event\EventParticipantService;

class EventParticipantController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(EventParticipantService $service)
    {
        $this->service = $service;
        $this->resourceColection = EventParticipantResource::class;
    }
}
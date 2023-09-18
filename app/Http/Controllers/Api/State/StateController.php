<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\Controller;
use App\Http\Resources\State\StateResource;
use App\Traits\HasResourceController;
use App\Service\State\StateService;

class StateController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(StateService $service)
    {
        $this->service = $service;
        $this->resourceColection = StateResource::class;
    }
}

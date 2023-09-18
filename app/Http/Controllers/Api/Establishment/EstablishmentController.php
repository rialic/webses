<?php

namespace App\Http\Controllers\Api\Establishment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Establishment\EstablishmentResource;
use App\Service\Establishment\EstablishmentService;
use App\Traits\HasResourceController;

class EstablishmentController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(EstablishmentService $service)
    {
        $this->service = $service;
        $this->resourceColection = EstablishmentResource::class;
    }
}

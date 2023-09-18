<?php

namespace App\Http\Controllers\Api\City;

use App\Http\Controllers\Controller;
use App\Http\Resources\City\CityResource;
use App\Traits\HasResourceController;
use App\Service\City\CityService;

class CityController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(CityService $service)
    {
        $this->service = $service;
        $this->resourceColection = CityResource::class;
    }
}

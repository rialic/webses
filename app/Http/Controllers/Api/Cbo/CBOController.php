<?php

namespace App\Http\Controllers\Api\Cbo;

use App\Http\Controllers\Controller;
use App\Traits\HasResourceController;
use App\Http\Resources\Cbo\CBOResource;
use App\Service\Cbo\CBOService;

class CBOController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(CBOService $service)
    {
        $this->service = $service;
        $this->resourceColection = CBOResource::class;
    }
}

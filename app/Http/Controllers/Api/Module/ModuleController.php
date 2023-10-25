<?php

namespace App\Http\Controllers\Api\Module;

use App\Http\Controllers\Controller;
use App\Traits\HasResourceController;
use App\Http\Resources\Module\ModuleResource;
use App\Service\Module\ModuleService;

class ModuleController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(ModuleService $service)
    {
        $this->service = $service;
        $this->resourceColection = ModuleResource::class;
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\RegisterResource;
use App\Service\Auth\RegisterService;
use App\Traits\HasResourceController;

class RegisterController extends Controller
{
    use HasResourceController;

    private $service;
    private $resourceColection;

    public function __construct(RegisterService $service)
    {
        $this->service = $service;
        $this->resourceColection = RegisterResource::class;
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\AuthResource;
use App\Service\Auth\AuthService;
class AuthController extends Controller
{
    private $service;
    private $resourceColection;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
        $this->resourceColection = AuthResource::class;
    }

    public function auth()
    {
        $user = $this->service->auth();

        return new $this->resourceColection($user);
    }

    public function logout()
    {
        $this->service->logout();

        return response()->json(['data' => (object) [], 'message' => 'Logout com sucesso.']);
    }
}

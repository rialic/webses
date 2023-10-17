<?php

namespace App\Http\Resources\Auth;

use App\Repository\Interfaces\UserInterface as UserRepository;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResource implements RegisterResponseContract
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = $this->userRepository->getFirstData(parseFilters(['cpf' => $request->cpf]));

        return [
            'uuid' => $user->uuid,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken($request->device_name)->plainTextToken
        ];
    }
}

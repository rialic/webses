<?php

namespace App\Http\Resources\Auth;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class AuthResource implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        return response()->json([
            'uuid' => $user->uuid,
            'name' => $user->name,
            'email' => $user->email,
            'verified_at' => $user->verified_at,
            'current_subdomain' => $user->current_subdomain
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthUser;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function auth(AuthUser $request)
    {
        $user = $this->model::where('us_email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => 'Email ou senha incorretos.']);
        }

        return (new UserResource($user))->additional(['token' => $user->createToken($request->device_name)->plainTextToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['data' => (object) [], 'message' => 'Logout successful.']);
    }

    public function me(Request $request)
    {
        $user =
        $request->user();

        return (new UserResource($user));
    }
}

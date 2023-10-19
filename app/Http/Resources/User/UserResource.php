<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->method() === 'POST' || $request->method() === 'PUT') {
            return [
                'uuid' => $this->uuid,
                'message' => 'Salvo com sucesso.'
            ];
        }

        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'verified_at' => $this->verified_at,
            'current_subdomain' => $this->current_subdomain,
            'abilities' => $this->roles->map(fn ($role) => $role->permissions->map(fn ($permission) => $permission->name))->flatten()
        ];
    }
}

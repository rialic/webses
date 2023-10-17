<?php

namespace App\Http\Resources\Establishment;

use App\Http\Resources\City\CityResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class EstablishmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'cnes' => $this->cnes,
            'legal_nature' => $this->legal_nature,
            'city' => new CityResource($this->city)
        ];
    }
}

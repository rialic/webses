<?php

namespace App\Http\Resources\Module;

use App\Http\Resources\Submodule\SubmoduleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $reques): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'submodules' => SubmoduleResource::collection($this->submodules)
        ];
    }
}

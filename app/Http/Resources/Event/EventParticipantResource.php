<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventParticipantResource extends JsonResource
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
            'title' => $this->name,
            'start_at' => $this->start_at,
            'start_at_formatted' => $this->start_at_formatted,
            'end_at' => $this->end_at,
            'end_at_formatted' => $this->end_at_formatted,
            'description' => $this->description,
            'room_link' => $this->room_link,
            'participants' => []
        ];
    }
}

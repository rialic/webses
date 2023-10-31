<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ev_name' => $this->faker->name,
            'ev_start_at' => date('Y-m-d H:i:s'),
            'ev_end_at' => date('Y-m-d H:i:s'),
            'ev_virtual_room' => 'TSMS',
            'ev_description' => $this->faker->text,
            'ev_room_link' => 'https://www.youtube.com/',
            'created_by' => 152,
            'tenant_id' => 1
        ];
    }
}

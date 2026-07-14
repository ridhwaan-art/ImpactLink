<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Organization;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'event_date' => now()->addDays(7)->toDateString(),
            'start_time' => '09:00',
            'end_time' => '11:00',
            'location' => $this->faker->city(),
            'maximum_volunteers' => 20,
            'status' => $this->faker->randomElement(['Scheduled', 'Completed', 'Cancelled']),
            'qr_token' => $this->faker->uuid(),
        ];
    }
}

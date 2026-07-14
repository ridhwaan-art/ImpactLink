<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_date' => now()->subDays(5)->toDateString(),
            'end_date' => now()->addDays(20)->toDateString(),
            'status' => $this->faker->randomElement(['Planning', 'Active', 'Completed']),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerFactory extends Factory
{
    protected $model = Volunteer::class;

    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'age_range' => $this->faker->randomElement(['Under 18', '18-24', '25-34', '35+']),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'location' => $this->faker->city(),
            'volunteer_type' => $this->faker->randomElement(['Student', 'Community Member']),
            'institution_name' => $this->faker->company(),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Suspended']),
            'qr_code' => $this->faker->uuid(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'program_name' => $this->faker->text(),
            'program_url' => $this->faker->url(),
            'provider_campus_city' => $this->faker->city(),
        ];
    }
}

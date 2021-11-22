<?php

namespace Database\Factories;
use App\Models\Provider;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'twc_id' => $this->faker->unique()->randomNumber(),
            'provider_id' => $this->faker->randomNumber(), // this needs to link to Provider table
            'name' => $this->faker->company(),
            'url' => $this->faker->unique()->url(),
            'description' => $this->faker->paragraph(2),
            'pre_reqs' => $this->faker->realText(10),
            'outcome' => $this->faker->sentence,
            'assoc_credential_name' => $this->faker->word,
            'length_hours' => $this->faker->randomDigit,
            'length_weeks' => $this->faker->randomDigit,
            'code_1' => $this->faker->randomDigit,
            'code_2' => $this->faker->randomDigit,
            'code_3' => $this->faker->randomDigit,
            'req_cost' => $this->faker->randomDigit,
            'num_apprentices' => $this->faker->randomDigit,
            'format' => $this->faker->sentence,
            'program_start_date' => $this->faker->dateTimeBetween($startDate = 'now',
                $endDate = '+1 year', $timezone = 'America/Chicago'), // Program starts in the future
            'program_last_updated' => $this->faker->dateTimeBetween($startDate = '-1 year',
                $endDate = 'now', $timezone = 'America/Chicago'), // Program was updated in the past year
           // 'program_last_updated' => $this->faker->randomDigit,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         *   Provider::create([
        'twc_id' => rand(),
        'name' => bin2hex(random_bytes($n)) . ' County College',
        'url' => 'https://' . bin2hex(random_bytes($n)) . '.com/',
        'description' => 'A description of provider',
        'provider_type_id' => rand('1','3')
        ]) ;
         */

        return [
            'twc_id' => $this->faker->randomNumber(),
            'name' => $this->faker->company(),
            'url' => $this->faker->unique()->url(),
            'description' => $this->faker->paragraph(10),
            'provider_type_id' => rand('1', '3')
        ];
//        return [
//            //
//        ];
    }
}

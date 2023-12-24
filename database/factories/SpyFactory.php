<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spy>
 */
class SpyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'agency' => $this->faker->name(),
            'country_of_operation' => $this->faker->name(),
            'dob' => $this->faker->date('Y-m-d')
        ];
    }
}

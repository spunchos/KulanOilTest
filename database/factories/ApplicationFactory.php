<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from'    => $this->faker->streetAddress(),
            'to'      => $this->faker->streetAddress(),
            'city_id' => City::factory()->create(),
            'user_id' => User::factory()->create(),
            'date'    => $this->faker->date(),
        ];
    }
}

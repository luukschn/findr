<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class extendedUserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country' => 1,
            'location' => 1,
            'jobTitle' => $this->faker->jobTitle(),
            'educationLevel' => 1,
            'gender' => 1,
            'bio' => $this->faker->text(40),
        ];
    }
}

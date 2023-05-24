<?php

namespace Database\Factories;

use App\Models\Scale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScaleResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'score' => $this->faker->numberBetween(0, 100),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'scale_id' => function () {
                return Scale::factory()->create()->id;
            }
        ];
    }
}

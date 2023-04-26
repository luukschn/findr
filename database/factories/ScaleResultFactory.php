<?php

namespace Database\Factories;

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
            'userId' => 1,
            'scaleId' => 1,
            'score' => random_int(1, 80)
        ];
    }
}

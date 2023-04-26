<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sourceAvg' => random_int(20, 40),
            'sourceSD' => random_int(1, 4),
            'completedCount' => random_int(1, 100),
        ];
    }
}

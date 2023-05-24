<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\DateTime;

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
            'internalName' => "scale-" . (string)random_int(1, 9000),
            'officialName' => $this->faker->company(),
            'reference' => $this->faker->bs(),
            'explanation' => $this->faker->paragraph(),
            'options' => "Strongly disagree, Disagree, Neutral, Agree, Strongly Agree",
            'referenceMean' => random_int(20, 40),
            'referenceSD' => random_int(1, 4),
            'completedCount' => random_int(1, 100),
            'created_at' => new DateTime()
        ];
    }
}

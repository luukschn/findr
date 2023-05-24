<?php

namespace Database\Factories;

use App\Models\ScaleQuestion;
use App\Models\ScaleResult;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScaleQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'scale_id' => function () {
                return \App\Models\Scale::factory()->create()->id;
            },
            'format' => random_int(0, 1),
            'question_text' => $this->faker->sentence(),
        ];
    }

    /**
     * Configure the model factory
     * 
     * @return $this
     */
    // public function configure() {
    //     return $this->afterCreating(function (ScaleQuestion $question) {
    //         $question->results()->createMany(
    //             ScaleResult::factory()->count(random_int(1, 5))->make()->toArray()
    //         );
    //     });
    // }
}

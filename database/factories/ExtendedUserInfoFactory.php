<?php

namespace Database\Factories;

use App\Models\ExtendedUserInfo;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExtendedUserInfoFactory extends Factory
{

    protected $model = ExtendedUserInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function() {
                return \App\Models\User::factory()->create()->id;
            },
            'country' => 1,
            'location' => random_int(1, 12),
            'jobTitle' => $this->faker->jobTitle(),
            'educationLevel' => random_int(1, 4),
            'gender' => random_int(0, 2),
            'bio' => $this->faker->text(40),
        ];
    }
}

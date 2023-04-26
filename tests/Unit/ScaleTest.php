<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class ScaleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_submit_scale_fail_incorrect_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $scale_data = [
            "value1" => 1
        ];

        $response = $this->post('submit-scale', $scale_data);
        $response->assertStatus(500);

    }
}

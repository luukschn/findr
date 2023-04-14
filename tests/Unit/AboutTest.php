<?php

namespace Tests\Unit;

use Tests\TestCase;

class AboutTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_about()
    {
        $response = $this->get('/about');

        $response->assertSee('Take the Loneliness Scale');
        $response->assertStatus(200);
    }
}

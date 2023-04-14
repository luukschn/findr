<?php

namespace Tests\Unit;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_dashboard()
    {
        $response = $this->get('/');

        $response->assertSee('Placeholder explanatory content');
        $response->assertStatus(200);
    }
}

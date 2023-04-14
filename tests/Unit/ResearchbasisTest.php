<?php

namespace Tests\Unit;

use Tests\TestCase;

class ResearchbasisTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_research_basis()
    {
        $response = $this->get('/research');

        $response->assertSee('Research basis');
        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class FinderTest extends TestCase
{
    use RefreshDatabase; 
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_finder_page_with_auth_success()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/finder');
        $response->assertStatus(200);
        $response->assertSee("Placeholder explanatory content");
    }
}

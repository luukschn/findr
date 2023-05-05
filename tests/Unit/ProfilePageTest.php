<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class ProfilePageTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_profile_page_with_auth_success()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/profile/' . Auth::id());
        $response->assertStatus(200);
        $response->assertSee("Profile Page");
    }
}

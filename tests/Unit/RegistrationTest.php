<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\TestHelpers;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_registration_page()
    {
        $response = $this->get('/register');

        $response->assertSee('Insert your details to register.');
        $response->assertStatus(200);
    }

    public function test_register_user_success() {

        //TODO write a helper function go generate the CSRF token
        $response = $this->get('/register');

        // // Set the token on the session to allow the request to be authenticated
        $regex = '/<input type="hidden" name="_token" value="(.+)"/';
        preg_match($regex, $response->getContent(), $matches);
        $token = $matches[0];

        // // Set the token on the session to allow the request to be authenticated
        $session = $this->app->make('session');
        $session->start();
        $session->put('_token', $token);        
        

        //TODO: fix the use of helper functions
        //TestHelpers::get_csrf_token();

        $registration_data = [
            'email' => 'a@b.com', 
            'name' => 'Luuk',
            'password' => 'secret',
            '_token' => $token
        ];

        // $response = $this->withSession(['_token' => csrf_token()])->post('/user/register', $registration_data);
        $postResponse = $this->post('user/register', $registration_data);

        $postResponse->assertStatus(302)->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'Luuk',
            'email' => 'a@b.com'
        ]);
    }
}

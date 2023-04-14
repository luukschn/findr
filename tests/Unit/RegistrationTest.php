<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_registration_page()
    {
        $response = $this->get('/register');

        $response->assertSee('Insert your details to register.');
        $response->assertStatus(200);
    }

    public function test_register_user_success() {

        //TODO write a helper function go generate the CSRF token
        // $app = $this->app;
        // $response = $this->get('/');

        // // Set the token on the session to allow the request to be authenticated

        // //both return empty arrays.
        // $regex = '/<input type="hidden" name="_token" value="(.+)"/';
        // // $regex = '/<meta name="csrf-token" content="(.*)">/';
        // preg_match($regex, $response->getContent(), $matches);
        // info($matches);
        // $token = $matches[1];

        // Set the token on the session to allow the request to be authenticated
        // $session = $app->make('session');
        // $session->start();
        // $session->put('_token', $token);



        $registration_data = [
            'email' => 'a@b.com', 
            'name' => 'Luuk',
            'password' => 'secret',
        ];

        // $response = $this->withSession(['_token' => csrf_token()])->post('/user/register', $registration_data);
        $response = $this->post('user/register', $registration_data);

        $response->assertStatus(302)->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'Luuk',
            'email' => 'a@b.com'
        ]);
    }
}

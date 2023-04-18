<?php

use Tests\TestCase;

class TestHelpers extends TestCase
{

    public function start_session($token) {
        $session = $this->app->make('session');
        $session->start();
        $session->put('_token', $token);
    }

    public function get_csrf_token() {
        $response = $this->get('/register');

        $regex = '/<input type="hidden" name="_token" value="(.+)"/';
        preg_match($regex, $response->getContent(), $matches);
        $token = $matches[0];

        TestHelpers::start_session($token);

        return $token;
    }

}

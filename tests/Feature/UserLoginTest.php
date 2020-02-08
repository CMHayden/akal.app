<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Tests if a user can view the login form
     *
     * @return true if status is 200
     * @return true if view is auth.login
     */
    public function testUserCanViewLoginForm()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');

    }
}

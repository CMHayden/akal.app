<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests if a user can view the registration form
     *
     * @return true if status is 200
     * @return true if view is auth.register
     */
    public function testUserCanViewRegistrationForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }


}

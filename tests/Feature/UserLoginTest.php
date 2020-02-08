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
    
    /**
     * Tests if an authenticated user can view the login form
     *
     * @return true if status is 302
     * @return true if redirected to /home
     */
    public function testAuthenticatedUserCannotViewLoginForm()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertStatus(302);

        $response->assertRedirect('/home');
    }
    
    /**
     * A logged in user can be logged out.
     *
     * @return void
     */
    public function testAuthenticatedUserCanLogOut()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(302);

        $this->assertGuest();
    }

    /**
     * A valid user can be logged in.
     *
     * @return void
     */
    public function testUserCanLogIn()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * An invalid user cannot be logged in.
     *
     * @return void
     */
    public function testInvalidUserCannotLogIn()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

}

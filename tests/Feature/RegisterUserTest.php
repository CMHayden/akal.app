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

    /**
     * Tests if an authenticated user can view the registration form
     *
     * @return true if status is 302
     * @return true if redirected to /home
     */
    public function testAuthenticatedUserCannotViewRegistrationForm()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/register');

        $response->assertStatus(302);

        $response->assertRedirect('/home');
    }

    /**
     * Tests if a carer user can register
     *
     * @return true if status is 302
     * @return true if redirected to home page
     * @return true if user is authenticated
     */
    public function testCarerUserCanRegister()
    {
        $user = factory(User::class)->make();

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'userType' => 'carer',
            'patientEmail' => 'testemail@test.net'
        ]);

        $response->assertStatus(302);
        
        $response->assertRedirect('/');

        $this->assertAuthenticated();
    }

    /**
     * Tests if a patient user can register
     *
     * @return true if status is 302
     * @return true if redirected to home page
     * @return true if user is authenticated
     */
    public function testPatientUserCanRegister()
    {
        $user = factory(User::class)->make();

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'userType' => 'patient',
            'patientEmail' => ''
        ]);

        $response->assertStatus(302);
        
        $response->assertRedirect('/');

        $this->assertAuthenticated();
    }

}

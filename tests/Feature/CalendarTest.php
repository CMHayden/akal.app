<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Calendar;
use Laravel\Passport\Passport;

class CalendarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexAsUser()
    {
        Passport::actingAs(factory(User::class)->create());

        $response = $this->get('/api/calendar');

        $response->assertStatus(200);
    }

    public function testIndexAsNoUser()
    {
        $response = $this->get('/api/calendar');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testStoreAsUser()
    {
        Passport::actingAs(factory(User::class)->create());

        $event = factory(Calendar::class)->create();
        $response = $this->json('POST', '/api/calendar', $event->toArray());

        $response->assertStatus(200);
    }

    public function testStoreAsNoUser()
    {
        $response = $this->post('/api/calendar');

        $response->assertStatus(302);
        $response->assertRedirect('/login');

    }

    public function testUpdateAsUser()
    {
        Passport::actingAs(factory(User::class)->create());

        $event = factory(Calendar::class)->create();

        $data = [
            'event_name' => 'Test',
            'start_date'    => '2020-04-01',
            'end_date'      => '2020-04-01',
            'patient_email' => 'test@email.net'
        ];

        $this->put("api/calendar/$event->id", $data)
             ->assertStatus(200);
            
    }

    public function testUpdateAsNoUser()
    {
        $event = factory(Calendar::class)->create();

        $data = [
            'event_name' => 'Test',
            'start_date'    => '2020-04-01',
            'end_date'      => '2020-04-01',
            'patient_email' => 'test@email.net'
        ];

        $this->put("api/calendar/$event->id", $data)
             ->assertStatus(302)
             ->assertRedirect('/login');

    }

    public function testDestroyAsUser()
    {
        Passport::actingAs(factory(User::class)->create());

        $event = factory(Calendar::class)->create();

        $this->delete("api/calendar/$event->id")
             ->assertStatus(204);

    }

    public function testDestroyAsNoUser()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');

    }
}

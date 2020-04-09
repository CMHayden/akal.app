<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlertsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAlertTemperature()
    {
        Passport::actingAs(factory(User::class)->create());

        $response = $this->get('/alert/2');

        $response->assertStatus(200);
    }
}

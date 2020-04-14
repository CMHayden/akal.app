<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemperatureTest extends TestCase
{
    public function testTemperatureUpdate()
    {
        Passport::actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/temperature/updateTemperatures', [
            'maxTemp' => '23',
            'minTemp' => '13'
            ]);

        $response->assertStatus(302)
                ->assertSessionHas('tempStatus', $value = "Successfully updated temperatures!");

    }
}

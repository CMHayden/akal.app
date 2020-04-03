<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WeatherTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanGetWeather()
    {
        $response = $this->get('/api/weather/55.860916,-4.251433');

        $response->assertStatus(200); 
    }
}

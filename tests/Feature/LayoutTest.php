<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LayoutTest extends TestCase
{
    public function testLayoutChange()
    {
        Passport::actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/layouts/updateLayouts', ['layoutChoice' => '3']);

        $response->assertStatus(302)
                ->assertSessionHas('layoutStatus', $value = "Successfully updated patients layout!");

    }
}

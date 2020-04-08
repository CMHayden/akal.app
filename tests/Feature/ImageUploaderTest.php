<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Laravel\Passport\Passport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
 
class ImageUploaderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUploadingImage()
    {
        Passport::actingAs(factory(User::class)->create());

        $file = UploadedFile::fake()->image('avatar.png')->size(100);

        $response = $this->json('POST', '/image-upload', [
            'image' => $file,
            'name' => "Just a test",
        ]);

        $response->assertStatus(302);

    }
}

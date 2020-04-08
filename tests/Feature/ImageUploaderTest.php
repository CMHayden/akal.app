<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\User;
 
class ImageUploaderTest extends TestCase
{
    /**
     * A basic feature test for uploading an image and 
     * asserting there is a redirect.
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

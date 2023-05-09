<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SocialMedia;

class SocialMediaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_social_media()
    {
        $socialMedia = SocialMedia::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/social_media', $socialMedia
        );

        $this->assertApiResponse($socialMedia);
    }

    /**
     * @test
     */
    public function test_read_social_media()
    {
        $socialMedia = SocialMedia::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/social_media/'.$socialMedia->id
        );

        $this->assertApiResponse($socialMedia->toArray());
    }

    /**
     * @test
     */
    public function test_update_social_media()
    {
        $socialMedia = SocialMedia::factory()->create();
        $editedSocialMedia = SocialMedia::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/social_media/'.$socialMedia->id,
            $editedSocialMedia
        );

        $this->assertApiResponse($editedSocialMedia);
    }

    /**
     * @test
     */
    public function test_delete_social_media()
    {
        $socialMedia = SocialMedia::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/social_media/'.$socialMedia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/social_media/'.$socialMedia->id
        );

        $this->response->assertStatus(404);
    }
}

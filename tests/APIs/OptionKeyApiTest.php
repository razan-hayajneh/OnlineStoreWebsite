<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OptionKey;

class OptionKeyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_option_key()
    {
        $optionKey = OptionKey::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/option_keys', $optionKey
        );

        $this->assertApiResponse($optionKey);
    }

    /**
     * @test
     */
    public function test_read_option_key()
    {
        $optionKey = OptionKey::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/option_keys/'.$optionKey->id
        );

        $this->assertApiResponse($optionKey->toArray());
    }

    /**
     * @test
     */
    public function test_update_option_key()
    {
        $optionKey = OptionKey::factory()->create();
        $editedOptionKey = OptionKey::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/option_keys/'.$optionKey->id,
            $editedOptionKey
        );

        $this->assertApiResponse($editedOptionKey);
    }

    /**
     * @test
     */
    public function test_delete_option_key()
    {
        $optionKey = OptionKey::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/option_keys/'.$optionKey->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/option_keys/'.$optionKey->id
        );

        $this->response->assertStatus(404);
    }
}

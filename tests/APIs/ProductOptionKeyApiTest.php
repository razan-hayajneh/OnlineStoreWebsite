<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductOptionKey;

class ProductOptionKeyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_option_keys', $productOptionKey
        );

        $this->assertApiResponse($productOptionKey);
    }

    /**
     * @test
     */
    public function test_read_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/product_option_keys/'.$productOptionKey->id
        );

        $this->assertApiResponse($productOptionKey->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->create();
        $editedProductOptionKey = ProductOptionKey::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_option_keys/'.$productOptionKey->id,
            $editedProductOptionKey
        );

        $this->assertApiResponse($editedProductOptionKey);
    }

    /**
     * @test
     */
    public function test_delete_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_option_keys/'.$productOptionKey->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_option_keys/'.$productOptionKey->id
        );

        $this->response->assertStatus(404);
    }
}

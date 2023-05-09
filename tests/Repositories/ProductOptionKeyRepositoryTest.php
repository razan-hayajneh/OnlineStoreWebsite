<?php namespace Tests\Repositories;

use App\Models\ProductOptionKey;
use App\Repositories\ProductOptionKeyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductOptionKeyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductOptionKeyRepository
     */
    protected $productOptionKeyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productOptionKeyRepo = \App::make(ProductOptionKeyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->make()->toArray();

        $createdProductOptionKey = $this->productOptionKeyRepo->create($productOptionKey);

        $createdProductOptionKey = $createdProductOptionKey->toArray();
        $this->assertArrayHasKey('id', $createdProductOptionKey);
        $this->assertNotNull($createdProductOptionKey['id'], 'Created ProductOptionKey must have id specified');
        $this->assertNotNull(ProductOptionKey::find($createdProductOptionKey['id']), 'ProductOptionKey with given id must be in DB');
        $this->assertModelData($productOptionKey, $createdProductOptionKey);
    }

    /**
     * @test read
     */
    public function test_read_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->create();

        $dbProductOptionKey = $this->productOptionKeyRepo->find($productOptionKey->id);

        $dbProductOptionKey = $dbProductOptionKey->toArray();
        $this->assertModelData($productOptionKey->toArray(), $dbProductOptionKey);
    }

    /**
     * @test update
     */
    public function test_update_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->create();
        $fakeProductOptionKey = ProductOptionKey::factory()->make()->toArray();

        $updatedProductOptionKey = $this->productOptionKeyRepo->update($fakeProductOptionKey, $productOptionKey->id);

        $this->assertModelData($fakeProductOptionKey, $updatedProductOptionKey->toArray());
        $dbProductOptionKey = $this->productOptionKeyRepo->find($productOptionKey->id);
        $this->assertModelData($fakeProductOptionKey, $dbProductOptionKey->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_option_key()
    {
        $productOptionKey = ProductOptionKey::factory()->create();

        $resp = $this->productOptionKeyRepo->delete($productOptionKey->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductOptionKey::find($productOptionKey->id), 'ProductOptionKey should not exist in DB');
    }
}

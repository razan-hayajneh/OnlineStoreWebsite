<?php namespace Tests\Repositories;

use App\Models\OptionKey;
use App\Repositories\OptionKeyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OptionKeyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OptionKeyRepository
     */
    protected $optionKeyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->optionKeyRepo = \App::make(OptionKeyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_option_key()
    {
        $optionKey = OptionKey::factory()->make()->toArray();

        $createdOptionKey = $this->optionKeyRepo->create($optionKey);

        $createdOptionKey = $createdOptionKey->toArray();
        $this->assertArrayHasKey('id', $createdOptionKey);
        $this->assertNotNull($createdOptionKey['id'], 'Created OptionKey must have id specified');
        $this->assertNotNull(OptionKey::find($createdOptionKey['id']), 'OptionKey with given id must be in DB');
        $this->assertModelData($optionKey, $createdOptionKey);
    }

    /**
     * @test read
     */
    public function test_read_option_key()
    {
        $optionKey = OptionKey::factory()->create();

        $dbOptionKey = $this->optionKeyRepo->find($optionKey->id);

        $dbOptionKey = $dbOptionKey->toArray();
        $this->assertModelData($optionKey->toArray(), $dbOptionKey);
    }

    /**
     * @test update
     */
    public function test_update_option_key()
    {
        $optionKey = OptionKey::factory()->create();
        $fakeOptionKey = OptionKey::factory()->make()->toArray();

        $updatedOptionKey = $this->optionKeyRepo->update($fakeOptionKey, $optionKey->id);

        $this->assertModelData($fakeOptionKey, $updatedOptionKey->toArray());
        $dbOptionKey = $this->optionKeyRepo->find($optionKey->id);
        $this->assertModelData($fakeOptionKey, $dbOptionKey->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_option_key()
    {
        $optionKey = OptionKey::factory()->create();

        $resp = $this->optionKeyRepo->delete($optionKey->id);

        $this->assertTrue($resp);
        $this->assertNull(OptionKey::find($optionKey->id), 'OptionKey should not exist in DB');
    }
}

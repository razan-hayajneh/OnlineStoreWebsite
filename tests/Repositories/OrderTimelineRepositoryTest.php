<?php namespace Tests\Repositories;

use App\Models\OrderTimeline;
use App\Repositories\OrderTimelineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderTimelineRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderTimelineRepository
     */
    protected $orderTimelineRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderTimelineRepo = \App::make(OrderTimelineRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->make()->toArray();

        $createdOrderTimeline = $this->orderTimelineRepo->create($orderTimeline);

        $createdOrderTimeline = $createdOrderTimeline->toArray();
        $this->assertArrayHasKey('id', $createdOrderTimeline);
        $this->assertNotNull($createdOrderTimeline['id'], 'Created OrderTimeline must have id specified');
        $this->assertNotNull(OrderTimeline::find($createdOrderTimeline['id']), 'OrderTimeline with given id must be in DB');
        $this->assertModelData($orderTimeline, $createdOrderTimeline);
    }

    /**
     * @test read
     */
    public function test_read_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->create();

        $dbOrderTimeline = $this->orderTimelineRepo->find($orderTimeline->id);

        $dbOrderTimeline = $dbOrderTimeline->toArray();
        $this->assertModelData($orderTimeline->toArray(), $dbOrderTimeline);
    }

    /**
     * @test update
     */
    public function test_update_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->create();
        $fakeOrderTimeline = OrderTimeline::factory()->make()->toArray();

        $updatedOrderTimeline = $this->orderTimelineRepo->update($fakeOrderTimeline, $orderTimeline->id);

        $this->assertModelData($fakeOrderTimeline, $updatedOrderTimeline->toArray());
        $dbOrderTimeline = $this->orderTimelineRepo->find($orderTimeline->id);
        $this->assertModelData($fakeOrderTimeline, $dbOrderTimeline->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->create();

        $resp = $this->orderTimelineRepo->delete($orderTimeline->id);

        $this->assertTrue($resp);
        $this->assertNull(OrderTimeline::find($orderTimeline->id), 'OrderTimeline should not exist in DB');
    }
}

<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrderTimeline;

class OrderTimelineApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_timelines', $orderTimeline
        );

        $this->assertApiResponse($orderTimeline);
    }

    /**
     * @test
     */
    public function test_read_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/order_timelines/'.$orderTimeline->id
        );

        $this->assertApiResponse($orderTimeline->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->create();
        $editedOrderTimeline = OrderTimeline::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_timelines/'.$orderTimeline->id,
            $editedOrderTimeline
        );

        $this->assertApiResponse($editedOrderTimeline);
    }

    /**
     * @test
     */
    public function test_delete_order_timeline()
    {
        $orderTimeline = OrderTimeline::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_timelines/'.$orderTimeline->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_timelines/'.$orderTimeline->id
        );

        $this->response->assertStatus(404);
    }
}

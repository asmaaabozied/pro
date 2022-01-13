<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrderActionsReason;

class OrderActionsReasonApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_actions_reasons', $orderActionsReason
        );

        $this->assertApiResponse($orderActionsReason);
    }

    /**
     * @test
     */
    public function test_read_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/order_actions_reasons/'.$orderActionsReason->id
        );

        $this->assertApiResponse($orderActionsReason->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->create();
        $editedOrderActionsReason = factory(OrderActionsReason::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_actions_reasons/'.$orderActionsReason->id,
            $editedOrderActionsReason
        );

        $this->assertApiResponse($editedOrderActionsReason);
    }

    /**
     * @test
     */
    public function test_delete_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_actions_reasons/'.$orderActionsReason->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_actions_reasons/'.$orderActionsReason->id
        );

        $this->response->assertStatus(404);
    }
}

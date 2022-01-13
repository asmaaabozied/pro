<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrderAction;

class OrderActionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_action()
    {
        $orderAction = factory(OrderAction::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_actions', $orderAction
        );

        $this->assertApiResponse($orderAction);
    }

    /**
     * @test
     */
    public function test_read_order_action()
    {
        $orderAction = factory(OrderAction::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/order_actions/'.$orderAction->id
        );

        $this->assertApiResponse($orderAction->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_action()
    {
        $orderAction = factory(OrderAction::class)->create();
        $editedOrderAction = factory(OrderAction::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_actions/'.$orderAction->id,
            $editedOrderAction
        );

        $this->assertApiResponse($editedOrderAction);
    }

    /**
     * @test
     */
    public function test_delete_order_action()
    {
        $orderAction = factory(OrderAction::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_actions/'.$orderAction->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_actions/'.$orderAction->id
        );

        $this->response->assertStatus(404);
    }
}

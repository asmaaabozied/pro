<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StoreSubscription;

class StoreSubscriptionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/store_subscriptions', $storeSubscription
        );

        $this->assertApiResponse($storeSubscription);
    }

    /**
     * @test
     */
    public function test_read_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/store_subscriptions/'.$storeSubscription->id
        );

        $this->assertApiResponse($storeSubscription->toArray());
    }

    /**
     * @test
     */
    public function test_update_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->create();
        $editedStoreSubscription = factory(StoreSubscription::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/store_subscriptions/'.$storeSubscription->id,
            $editedStoreSubscription
        );

        $this->assertApiResponse($editedStoreSubscription);
    }

    /**
     * @test
     */
    public function test_delete_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/store_subscriptions/'.$storeSubscription->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/store_subscriptions/'.$storeSubscription->id
        );

        $this->response->assertStatus(404);
    }
}

<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Store;

class StoreApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_store()
    {
        $store = factory(Store::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stores', $store
        );

        $this->assertApiResponse($store);
    }

    /**
     * @test
     */
    public function test_read_store()
    {
        $store = factory(Store::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/stores/'.$store->id
        );

        $this->assertApiResponse($store->toArray());
    }

    /**
     * @test
     */
    public function test_update_store()
    {
        $store = factory(Store::class)->create();
        $editedStore = factory(Store::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stores/'.$store->id,
            $editedStore
        );

        $this->assertApiResponse($editedStore);
    }

    /**
     * @test
     */
    public function test_delete_store()
    {
        $store = factory(Store::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stores/'.$store->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stores/'.$store->id
        );

        $this->response->assertStatus(404);
    }
}

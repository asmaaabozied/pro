<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StoreType;

class StoreTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_store_type()
    {
        $storeType = factory(StoreType::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/store_types', $storeType
        );

        $this->assertApiResponse($storeType);
    }

    /**
     * @test
     */
    public function test_read_store_type()
    {
        $storeType = factory(StoreType::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/store_types/'.$storeType->id
        );

        $this->assertApiResponse($storeType->toArray());
    }

    /**
     * @test
     */
    public function test_update_store_type()
    {
        $storeType = factory(StoreType::class)->create();
        $editedStoreType = factory(StoreType::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/store_types/'.$storeType->id,
            $editedStoreType
        );

        $this->assertApiResponse($editedStoreType);
    }

    /**
     * @test
     */
    public function test_delete_store_type()
    {
        $storeType = factory(StoreType::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/store_types/'.$storeType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/store_types/'.$storeType->id
        );

        $this->response->assertStatus(404);
    }
}

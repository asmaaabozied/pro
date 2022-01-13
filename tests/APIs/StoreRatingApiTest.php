<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StoreRating;

class StoreRatingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_store_rating()
    {
        $storeRating = factory(StoreRating::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/store_ratings', $storeRating
        );

        $this->assertApiResponse($storeRating);
    }

    /**
     * @test
     */
    public function test_read_store_rating()
    {
        $storeRating = factory(StoreRating::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/store_ratings/'.$storeRating->id
        );

        $this->assertApiResponse($storeRating->toArray());
    }

    /**
     * @test
     */
    public function test_update_store_rating()
    {
        $storeRating = factory(StoreRating::class)->create();
        $editedStoreRating = factory(StoreRating::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/store_ratings/'.$storeRating->id,
            $editedStoreRating
        );

        $this->assertApiResponse($editedStoreRating);
    }

    /**
     * @test
     */
    public function test_delete_store_rating()
    {
        $storeRating = factory(StoreRating::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/store_ratings/'.$storeRating->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/store_ratings/'.$storeRating->id
        );

        $this->response->assertStatus(404);
    }
}

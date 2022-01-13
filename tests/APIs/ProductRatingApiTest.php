<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductRating;

class ProductRatingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_rating()
    {
        $productRating = factory(ProductRating::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_ratings', $productRating
        );

        $this->assertApiResponse($productRating);
    }

    /**
     * @test
     */
    public function test_read_product_rating()
    {
        $productRating = factory(ProductRating::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/product_ratings/'.$productRating->id
        );

        $this->assertApiResponse($productRating->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_rating()
    {
        $productRating = factory(ProductRating::class)->create();
        $editedProductRating = factory(ProductRating::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_ratings/'.$productRating->id,
            $editedProductRating
        );

        $this->assertApiResponse($editedProductRating);
    }

    /**
     * @test
     */
    public function test_delete_product_rating()
    {
        $productRating = factory(ProductRating::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_ratings/'.$productRating->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_ratings/'.$productRating->id
        );

        $this->response->assertStatus(404);
    }
}

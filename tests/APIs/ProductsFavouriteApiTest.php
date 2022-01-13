<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductsFavourite;

class ProductsFavouriteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/products_favourites', $productsFavourite
        );

        $this->assertApiResponse($productsFavourite);
    }

    /**
     * @test
     */
    public function test_read_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/products_favourites/'.$productsFavourite->id
        );

        $this->assertApiResponse($productsFavourite->toArray());
    }

    /**
     * @test
     */
    public function test_update_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->create();
        $editedProductsFavourite = factory(ProductsFavourite::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/products_favourites/'.$productsFavourite->id,
            $editedProductsFavourite
        );

        $this->assertApiResponse($editedProductsFavourite);
    }

    /**
     * @test
     */
    public function test_delete_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/products_favourites/'.$productsFavourite->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/products_favourites/'.$productsFavourite->id
        );

        $this->response->assertStatus(404);
    }
}

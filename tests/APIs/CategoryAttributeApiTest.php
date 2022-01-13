<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CategoryAttribute;

class CategoryAttributeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/category_attributes', $categoryAttribute
        );

        $this->assertApiResponse($categoryAttribute);
    }

    /**
     * @test
     */
    public function test_read_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/category_attributes/'.$categoryAttribute->id
        );

        $this->assertApiResponse($categoryAttribute->toArray());
    }

    /**
     * @test
     */
    public function test_update_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->create();
        $editedCategoryAttribute = factory(CategoryAttribute::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/category_attributes/'.$categoryAttribute->id,
            $editedCategoryAttribute
        );

        $this->assertApiResponse($editedCategoryAttribute);
    }

    /**
     * @test
     */
    public function test_delete_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/category_attributes/'.$categoryAttribute->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/category_attributes/'.$categoryAttribute->id
        );

        $this->response->assertStatus(404);
    }
}

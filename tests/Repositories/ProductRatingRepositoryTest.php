<?php namespace Tests\Repositories;

use App\Models\ProductRating;
use App\Repositories\ProductRatingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductRatingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductRatingRepository
     */
    protected $productRatingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productRatingRepo = \App::make(ProductRatingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_rating()
    {
        $productRating = factory(ProductRating::class)->make()->toArray();

        $createdProductRating = $this->productRatingRepo->create($productRating);

        $createdProductRating = $createdProductRating->toArray();
        $this->assertArrayHasKey('id', $createdProductRating);
        $this->assertNotNull($createdProductRating['id'], 'Created ProductRating must have id specified');
        $this->assertNotNull(ProductRating::find($createdProductRating['id']), 'ProductRating with given id must be in DB');
        $this->assertModelData($productRating, $createdProductRating);
    }

    /**
     * @test read
     */
    public function test_read_product_rating()
    {
        $productRating = factory(ProductRating::class)->create();

        $dbProductRating = $this->productRatingRepo->find($productRating->id);

        $dbProductRating = $dbProductRating->toArray();
        $this->assertModelData($productRating->toArray(), $dbProductRating);
    }

    /**
     * @test update
     */
    public function test_update_product_rating()
    {
        $productRating = factory(ProductRating::class)->create();
        $fakeProductRating = factory(ProductRating::class)->make()->toArray();

        $updatedProductRating = $this->productRatingRepo->update($fakeProductRating, $productRating->id);

        $this->assertModelData($fakeProductRating, $updatedProductRating->toArray());
        $dbProductRating = $this->productRatingRepo->find($productRating->id);
        $this->assertModelData($fakeProductRating, $dbProductRating->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_rating()
    {
        $productRating = factory(ProductRating::class)->create();

        $resp = $this->productRatingRepo->delete($productRating->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductRating::find($productRating->id), 'ProductRating should not exist in DB');
    }
}

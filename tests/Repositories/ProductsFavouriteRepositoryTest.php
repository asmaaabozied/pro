<?php namespace Tests\Repositories;

use App\Models\ProductsFavourite;
use App\Repositories\ProductsFavouriteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductsFavouriteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductsFavouriteRepository
     */
    protected $productsFavouriteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productsFavouriteRepo = \App::make(ProductsFavouriteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->make()->toArray();

        $createdProductsFavourite = $this->productsFavouriteRepo->create($productsFavourite);

        $createdProductsFavourite = $createdProductsFavourite->toArray();
        $this->assertArrayHasKey('id', $createdProductsFavourite);
        $this->assertNotNull($createdProductsFavourite['id'], 'Created ProductsFavourite must have id specified');
        $this->assertNotNull(ProductsFavourite::find($createdProductsFavourite['id']), 'ProductsFavourite with given id must be in DB');
        $this->assertModelData($productsFavourite, $createdProductsFavourite);
    }

    /**
     * @test read
     */
    public function test_read_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->create();

        $dbProductsFavourite = $this->productsFavouriteRepo->find($productsFavourite->id);

        $dbProductsFavourite = $dbProductsFavourite->toArray();
        $this->assertModelData($productsFavourite->toArray(), $dbProductsFavourite);
    }

    /**
     * @test update
     */
    public function test_update_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->create();
        $fakeProductsFavourite = factory(ProductsFavourite::class)->make()->toArray();

        $updatedProductsFavourite = $this->productsFavouriteRepo->update($fakeProductsFavourite, $productsFavourite->id);

        $this->assertModelData($fakeProductsFavourite, $updatedProductsFavourite->toArray());
        $dbProductsFavourite = $this->productsFavouriteRepo->find($productsFavourite->id);
        $this->assertModelData($fakeProductsFavourite, $dbProductsFavourite->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_products_favourite()
    {
        $productsFavourite = factory(ProductsFavourite::class)->create();

        $resp = $this->productsFavouriteRepo->delete($productsFavourite->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductsFavourite::find($productsFavourite->id), 'ProductsFavourite should not exist in DB');
    }
}

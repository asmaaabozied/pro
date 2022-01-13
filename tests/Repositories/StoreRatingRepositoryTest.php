<?php namespace Tests\Repositories;

use App\Models\StoreRating;
use App\Repositories\StoreRatingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StoreRatingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StoreRatingRepository
     */
    protected $storeRatingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->storeRatingRepo = \App::make(StoreRatingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_store_rating()
    {
        $storeRating = factory(StoreRating::class)->make()->toArray();

        $createdStoreRating = $this->storeRatingRepo->create($storeRating);

        $createdStoreRating = $createdStoreRating->toArray();
        $this->assertArrayHasKey('id', $createdStoreRating);
        $this->assertNotNull($createdStoreRating['id'], 'Created StoreRating must have id specified');
        $this->assertNotNull(StoreRating::find($createdStoreRating['id']), 'StoreRating with given id must be in DB');
        $this->assertModelData($storeRating, $createdStoreRating);
    }

    /**
     * @test read
     */
    public function test_read_store_rating()
    {
        $storeRating = factory(StoreRating::class)->create();

        $dbStoreRating = $this->storeRatingRepo->find($storeRating->id);

        $dbStoreRating = $dbStoreRating->toArray();
        $this->assertModelData($storeRating->toArray(), $dbStoreRating);
    }

    /**
     * @test update
     */
    public function test_update_store_rating()
    {
        $storeRating = factory(StoreRating::class)->create();
        $fakeStoreRating = factory(StoreRating::class)->make()->toArray();

        $updatedStoreRating = $this->storeRatingRepo->update($fakeStoreRating, $storeRating->id);

        $this->assertModelData($fakeStoreRating, $updatedStoreRating->toArray());
        $dbStoreRating = $this->storeRatingRepo->find($storeRating->id);
        $this->assertModelData($fakeStoreRating, $dbStoreRating->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_store_rating()
    {
        $storeRating = factory(StoreRating::class)->create();

        $resp = $this->storeRatingRepo->delete($storeRating->id);

        $this->assertTrue($resp);
        $this->assertNull(StoreRating::find($storeRating->id), 'StoreRating should not exist in DB');
    }
}

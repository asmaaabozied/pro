<?php namespace Tests\Repositories;

use App\Models\Store;
use App\Repositories\StoreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StoreRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StoreRepository
     */
    protected $storeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->storeRepo = \App::make(StoreRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_store()
    {
        $store = factory(Store::class)->make()->toArray();

        $createdStore = $this->storeRepo->create($store);

        $createdStore = $createdStore->toArray();
        $this->assertArrayHasKey('id', $createdStore);
        $this->assertNotNull($createdStore['id'], 'Created Store must have id specified');
        $this->assertNotNull(Store::find($createdStore['id']), 'Store with given id must be in DB');
        $this->assertModelData($store, $createdStore);
    }

    /**
     * @test read
     */
    public function test_read_store()
    {
        $store = factory(Store::class)->create();

        $dbStore = $this->storeRepo->find($store->id);

        $dbStore = $dbStore->toArray();
        $this->assertModelData($store->toArray(), $dbStore);
    }

    /**
     * @test update
     */
    public function test_update_store()
    {
        $store = factory(Store::class)->create();
        $fakeStore = factory(Store::class)->make()->toArray();

        $updatedStore = $this->storeRepo->update($fakeStore, $store->id);

        $this->assertModelData($fakeStore, $updatedStore->toArray());
        $dbStore = $this->storeRepo->find($store->id);
        $this->assertModelData($fakeStore, $dbStore->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_store()
    {
        $store = factory(Store::class)->create();

        $resp = $this->storeRepo->delete($store->id);

        $this->assertTrue($resp);
        $this->assertNull(Store::find($store->id), 'Store should not exist in DB');
    }
}

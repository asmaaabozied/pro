<?php namespace Tests\Repositories;

use App\Models\StoreType;
use App\Repositories\StoreTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StoreTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StoreTypeRepository
     */
    protected $storeTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->storeTypeRepo = \App::make(StoreTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_store_type()
    {
        $storeType = factory(StoreType::class)->make()->toArray();

        $createdStoreType = $this->storeTypeRepo->create($storeType);

        $createdStoreType = $createdStoreType->toArray();
        $this->assertArrayHasKey('id', $createdStoreType);
        $this->assertNotNull($createdStoreType['id'], 'Created StoreType must have id specified');
        $this->assertNotNull(StoreType::find($createdStoreType['id']), 'StoreType with given id must be in DB');
        $this->assertModelData($storeType, $createdStoreType);
    }

    /**
     * @test read
     */
    public function test_read_store_type()
    {
        $storeType = factory(StoreType::class)->create();

        $dbStoreType = $this->storeTypeRepo->find($storeType->id);

        $dbStoreType = $dbStoreType->toArray();
        $this->assertModelData($storeType->toArray(), $dbStoreType);
    }

    /**
     * @test update
     */
    public function test_update_store_type()
    {
        $storeType = factory(StoreType::class)->create();
        $fakeStoreType = factory(StoreType::class)->make()->toArray();

        $updatedStoreType = $this->storeTypeRepo->update($fakeStoreType, $storeType->id);

        $this->assertModelData($fakeStoreType, $updatedStoreType->toArray());
        $dbStoreType = $this->storeTypeRepo->find($storeType->id);
        $this->assertModelData($fakeStoreType, $dbStoreType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_store_type()
    {
        $storeType = factory(StoreType::class)->create();

        $resp = $this->storeTypeRepo->delete($storeType->id);

        $this->assertTrue($resp);
        $this->assertNull(StoreType::find($storeType->id), 'StoreType should not exist in DB');
    }
}

<?php namespace Tests\Repositories;

use App\Models\StoreSubscription;
use App\Repositories\StoreSubscriptionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StoreSubscriptionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StoreSubscriptionRepository
     */
    protected $storeSubscriptionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->storeSubscriptionRepo = \App::make(StoreSubscriptionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->make()->toArray();

        $createdStoreSubscription = $this->storeSubscriptionRepo->create($storeSubscription);

        $createdStoreSubscription = $createdStoreSubscription->toArray();
        $this->assertArrayHasKey('id', $createdStoreSubscription);
        $this->assertNotNull($createdStoreSubscription['id'], 'Created StoreSubscription must have id specified');
        $this->assertNotNull(StoreSubscription::find($createdStoreSubscription['id']), 'StoreSubscription with given id must be in DB');
        $this->assertModelData($storeSubscription, $createdStoreSubscription);
    }

    /**
     * @test read
     */
    public function test_read_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->create();

        $dbStoreSubscription = $this->storeSubscriptionRepo->find($storeSubscription->id);

        $dbStoreSubscription = $dbStoreSubscription->toArray();
        $this->assertModelData($storeSubscription->toArray(), $dbStoreSubscription);
    }

    /**
     * @test update
     */
    public function test_update_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->create();
        $fakeStoreSubscription = factory(StoreSubscription::class)->make()->toArray();

        $updatedStoreSubscription = $this->storeSubscriptionRepo->update($fakeStoreSubscription, $storeSubscription->id);

        $this->assertModelData($fakeStoreSubscription, $updatedStoreSubscription->toArray());
        $dbStoreSubscription = $this->storeSubscriptionRepo->find($storeSubscription->id);
        $this->assertModelData($fakeStoreSubscription, $dbStoreSubscription->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_store_subscription()
    {
        $storeSubscription = factory(StoreSubscription::class)->create();

        $resp = $this->storeSubscriptionRepo->delete($storeSubscription->id);

        $this->assertTrue($resp);
        $this->assertNull(StoreSubscription::find($storeSubscription->id), 'StoreSubscription should not exist in DB');
    }
}

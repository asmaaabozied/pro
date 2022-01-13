<?php namespace Tests\Repositories;

use App\Models\OrderAction;
use App\Repositories\OrderActionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderActionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderActionRepository
     */
    protected $orderActionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderActionRepo = \App::make(OrderActionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_action()
    {
        $orderAction = factory(OrderAction::class)->make()->toArray();

        $createdOrderAction = $this->orderActionRepo->create($orderAction);

        $createdOrderAction = $createdOrderAction->toArray();
        $this->assertArrayHasKey('id', $createdOrderAction);
        $this->assertNotNull($createdOrderAction['id'], 'Created OrderAction must have id specified');
        $this->assertNotNull(OrderAction::find($createdOrderAction['id']), 'OrderAction with given id must be in DB');
        $this->assertModelData($orderAction, $createdOrderAction);
    }

    /**
     * @test read
     */
    public function test_read_order_action()
    {
        $orderAction = factory(OrderAction::class)->create();

        $dbOrderAction = $this->orderActionRepo->find($orderAction->id);

        $dbOrderAction = $dbOrderAction->toArray();
        $this->assertModelData($orderAction->toArray(), $dbOrderAction);
    }

    /**
     * @test update
     */
    public function test_update_order_action()
    {
        $orderAction = factory(OrderAction::class)->create();
        $fakeOrderAction = factory(OrderAction::class)->make()->toArray();

        $updatedOrderAction = $this->orderActionRepo->update($fakeOrderAction, $orderAction->id);

        $this->assertModelData($fakeOrderAction, $updatedOrderAction->toArray());
        $dbOrderAction = $this->orderActionRepo->find($orderAction->id);
        $this->assertModelData($fakeOrderAction, $dbOrderAction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_action()
    {
        $orderAction = factory(OrderAction::class)->create();

        $resp = $this->orderActionRepo->delete($orderAction->id);

        $this->assertTrue($resp);
        $this->assertNull(OrderAction::find($orderAction->id), 'OrderAction should not exist in DB');
    }
}

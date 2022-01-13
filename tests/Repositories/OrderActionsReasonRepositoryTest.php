<?php namespace Tests\Repositories;

use App\Models\OrderActionsReason;
use App\Repositories\OrderActionsReasonRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderActionsReasonRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderActionsReasonRepository
     */
    protected $orderActionsReasonRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderActionsReasonRepo = \App::make(OrderActionsReasonRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->make()->toArray();

        $createdOrderActionsReason = $this->orderActionsReasonRepo->create($orderActionsReason);

        $createdOrderActionsReason = $createdOrderActionsReason->toArray();
        $this->assertArrayHasKey('id', $createdOrderActionsReason);
        $this->assertNotNull($createdOrderActionsReason['id'], 'Created OrderActionsReason must have id specified');
        $this->assertNotNull(OrderActionsReason::find($createdOrderActionsReason['id']), 'OrderActionsReason with given id must be in DB');
        $this->assertModelData($orderActionsReason, $createdOrderActionsReason);
    }

    /**
     * @test read
     */
    public function test_read_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->create();

        $dbOrderActionsReason = $this->orderActionsReasonRepo->find($orderActionsReason->id);

        $dbOrderActionsReason = $dbOrderActionsReason->toArray();
        $this->assertModelData($orderActionsReason->toArray(), $dbOrderActionsReason);
    }

    /**
     * @test update
     */
    public function test_update_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->create();
        $fakeOrderActionsReason = factory(OrderActionsReason::class)->make()->toArray();

        $updatedOrderActionsReason = $this->orderActionsReasonRepo->update($fakeOrderActionsReason, $orderActionsReason->id);

        $this->assertModelData($fakeOrderActionsReason, $updatedOrderActionsReason->toArray());
        $dbOrderActionsReason = $this->orderActionsReasonRepo->find($orderActionsReason->id);
        $this->assertModelData($fakeOrderActionsReason, $dbOrderActionsReason->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_actions_reason()
    {
        $orderActionsReason = factory(OrderActionsReason::class)->create();

        $resp = $this->orderActionsReasonRepo->delete($orderActionsReason->id);

        $this->assertTrue($resp);
        $this->assertNull(OrderActionsReason::find($orderActionsReason->id), 'OrderActionsReason should not exist in DB');
    }
}

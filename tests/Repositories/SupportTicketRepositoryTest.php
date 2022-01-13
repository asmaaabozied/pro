<?php namespace Tests\Repositories;

use App\Models\SupportTicket;
use App\Repositories\SupportTicketRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SupportTicketRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SupportTicketRepository
     */
    protected $supportTicketRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->supportTicketRepo = \App::make(SupportTicketRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->make()->toArray();

        $createdSupportTicket = $this->supportTicketRepo->create($supportTicket);

        $createdSupportTicket = $createdSupportTicket->toArray();
        $this->assertArrayHasKey('id', $createdSupportTicket);
        $this->assertNotNull($createdSupportTicket['id'], 'Created SupportTicket must have id specified');
        $this->assertNotNull(SupportTicket::find($createdSupportTicket['id']), 'SupportTicket with given id must be in DB');
        $this->assertModelData($supportTicket, $createdSupportTicket);
    }

    /**
     * @test read
     */
    public function test_read_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->create();

        $dbSupportTicket = $this->supportTicketRepo->find($supportTicket->id);

        $dbSupportTicket = $dbSupportTicket->toArray();
        $this->assertModelData($supportTicket->toArray(), $dbSupportTicket);
    }

    /**
     * @test update
     */
    public function test_update_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->create();
        $fakeSupportTicket = factory(SupportTicket::class)->make()->toArray();

        $updatedSupportTicket = $this->supportTicketRepo->update($fakeSupportTicket, $supportTicket->id);

        $this->assertModelData($fakeSupportTicket, $updatedSupportTicket->toArray());
        $dbSupportTicket = $this->supportTicketRepo->find($supportTicket->id);
        $this->assertModelData($fakeSupportTicket, $dbSupportTicket->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->create();

        $resp = $this->supportTicketRepo->delete($supportTicket->id);

        $this->assertTrue($resp);
        $this->assertNull(SupportTicket::find($supportTicket->id), 'SupportTicket should not exist in DB');
    }
}

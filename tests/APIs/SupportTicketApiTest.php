<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SupportTicket;

class SupportTicketApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/support_tickets', $supportTicket
        );

        $this->assertApiResponse($supportTicket);
    }

    /**
     * @test
     */
    public function test_read_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/support_tickets/'.$supportTicket->id
        );

        $this->assertApiResponse($supportTicket->toArray());
    }

    /**
     * @test
     */
    public function test_update_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->create();
        $editedSupportTicket = factory(SupportTicket::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/support_tickets/'.$supportTicket->id,
            $editedSupportTicket
        );

        $this->assertApiResponse($editedSupportTicket);
    }

    /**
     * @test
     */
    public function test_delete_support_ticket()
    {
        $supportTicket = factory(SupportTicket::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/support_tickets/'.$supportTicket->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/support_tickets/'.$supportTicket->id
        );

        $this->response->assertStatus(404);
    }
}

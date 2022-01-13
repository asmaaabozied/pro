<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SocialMediaLink;

class SocialMediaLinkApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/social_media_links', $socialMediaLink
        );

        $this->assertApiResponse($socialMediaLink);
    }

    /**
     * @test
     */
    public function test_read_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/social_media_links/'.$socialMediaLink->id
        );

        $this->assertApiResponse($socialMediaLink->toArray());
    }

    /**
     * @test
     */
    public function test_update_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->create();
        $editedSocialMediaLink = factory(SocialMediaLink::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/social_media_links/'.$socialMediaLink->id,
            $editedSocialMediaLink
        );

        $this->assertApiResponse($editedSocialMediaLink);
    }

    /**
     * @test
     */
    public function test_delete_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/social_media_links/'.$socialMediaLink->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/social_media_links/'.$socialMediaLink->id
        );

        $this->response->assertStatus(404);
    }
}

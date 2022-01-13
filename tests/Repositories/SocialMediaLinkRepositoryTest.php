<?php namespace Tests\Repositories;

use App\Models\SocialMediaLink;
use App\Repositories\SocialMediaLinkRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SocialMediaLinkRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SocialMediaLinkRepository
     */
    protected $socialMediaLinkRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->socialMediaLinkRepo = \App::make(SocialMediaLinkRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->make()->toArray();

        $createdSocialMediaLink = $this->socialMediaLinkRepo->create($socialMediaLink);

        $createdSocialMediaLink = $createdSocialMediaLink->toArray();
        $this->assertArrayHasKey('id', $createdSocialMediaLink);
        $this->assertNotNull($createdSocialMediaLink['id'], 'Created SocialMediaLink must have id specified');
        $this->assertNotNull(SocialMediaLink::find($createdSocialMediaLink['id']), 'SocialMediaLink with given id must be in DB');
        $this->assertModelData($socialMediaLink, $createdSocialMediaLink);
    }

    /**
     * @test read
     */
    public function test_read_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->create();

        $dbSocialMediaLink = $this->socialMediaLinkRepo->find($socialMediaLink->id);

        $dbSocialMediaLink = $dbSocialMediaLink->toArray();
        $this->assertModelData($socialMediaLink->toArray(), $dbSocialMediaLink);
    }

    /**
     * @test update
     */
    public function test_update_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->create();
        $fakeSocialMediaLink = factory(SocialMediaLink::class)->make()->toArray();

        $updatedSocialMediaLink = $this->socialMediaLinkRepo->update($fakeSocialMediaLink, $socialMediaLink->id);

        $this->assertModelData($fakeSocialMediaLink, $updatedSocialMediaLink->toArray());
        $dbSocialMediaLink = $this->socialMediaLinkRepo->find($socialMediaLink->id);
        $this->assertModelData($fakeSocialMediaLink, $dbSocialMediaLink->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_social_media_link()
    {
        $socialMediaLink = factory(SocialMediaLink::class)->create();

        $resp = $this->socialMediaLinkRepo->delete($socialMediaLink->id);

        $this->assertTrue($resp);
        $this->assertNull(SocialMediaLink::find($socialMediaLink->id), 'SocialMediaLink should not exist in DB');
    }
}

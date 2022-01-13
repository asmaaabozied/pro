<?php namespace Tests\Repositories;

use App\Models\AboutUs;
use App\Repositories\AboutUsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AboutUsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AboutUsRepository
     */
    protected $aboutUsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->aboutUsRepo = \App::make(AboutUsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_about_us()
    {
        $aboutUs = factory(AboutUs::class)->make()->toArray();

        $createdAboutUs = $this->aboutUsRepo->create($aboutUs);

        $createdAboutUs = $createdAboutUs->toArray();
        $this->assertArrayHasKey('id', $createdAboutUs);
        $this->assertNotNull($createdAboutUs['id'], 'Created AboutUs must have id specified');
        $this->assertNotNull(AboutUs::find($createdAboutUs['id']), 'AboutUs with given id must be in DB');
        $this->assertModelData($aboutUs, $createdAboutUs);
    }

    /**
     * @test read
     */
    public function test_read_about_us()
    {
        $aboutUs = factory(AboutUs::class)->create();

        $dbAboutUs = $this->aboutUsRepo->find($aboutUs->id);

        $dbAboutUs = $dbAboutUs->toArray();
        $this->assertModelData($aboutUs->toArray(), $dbAboutUs);
    }

    /**
     * @test update
     */
    public function test_update_about_us()
    {
        $aboutUs = factory(AboutUs::class)->create();
        $fakeAboutUs = factory(AboutUs::class)->make()->toArray();

        $updatedAboutUs = $this->aboutUsRepo->update($fakeAboutUs, $aboutUs->id);

        $this->assertModelData($fakeAboutUs, $updatedAboutUs->toArray());
        $dbAboutUs = $this->aboutUsRepo->find($aboutUs->id);
        $this->assertModelData($fakeAboutUs, $dbAboutUs->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_about_us()
    {
        $aboutUs = factory(AboutUs::class)->create();

        $resp = $this->aboutUsRepo->delete($aboutUs->id);

        $this->assertTrue($resp);
        $this->assertNull(AboutUs::find($aboutUs->id), 'AboutUs should not exist in DB');
    }
}

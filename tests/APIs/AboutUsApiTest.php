<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AboutUs;

class AboutUsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_about_us()
    {
        $aboutUs = factory(AboutUs::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/aboutuses', $aboutUs
        );

        $this->assertApiResponse($aboutUs);
    }

    /**
     * @test
     */
    public function test_read_about_us()
    {
        $aboutUs = factory(AboutUs::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/aboutuses/'.$aboutUs->id
        );

        $this->assertApiResponse($aboutUs->toArray());
    }

    /**
     * @test
     */
    public function test_update_about_us()
    {
        $aboutUs = factory(AboutUs::class)->create();
        $editedAboutUs = factory(AboutUs::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/aboutuses/'.$aboutUs->id,
            $editedAboutUs
        );

        $this->assertApiResponse($editedAboutUs);
    }

    /**
     * @test
     */
    public function test_delete_about_us()
    {
        $aboutUs = factory(AboutUs::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/aboutuses/'.$aboutUs->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/aboutuses/'.$aboutUs->id
        );

        $this->response->assertStatus(404);
    }
}

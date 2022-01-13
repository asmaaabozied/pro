<?php namespace Tests\Repositories;

use App\Models\CategoryAttribute;
use App\Repositories\CategoryAttributeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CategoryAttributeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoryAttributeRepository
     */
    protected $categoryAttributeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->categoryAttributeRepo = \App::make(CategoryAttributeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->make()->toArray();

        $createdCategoryAttribute = $this->categoryAttributeRepo->create($categoryAttribute);

        $createdCategoryAttribute = $createdCategoryAttribute->toArray();
        $this->assertArrayHasKey('id', $createdCategoryAttribute);
        $this->assertNotNull($createdCategoryAttribute['id'], 'Created CategoryAttribute must have id specified');
        $this->assertNotNull(CategoryAttribute::find($createdCategoryAttribute['id']), 'CategoryAttribute with given id must be in DB');
        $this->assertModelData($categoryAttribute, $createdCategoryAttribute);
    }

    /**
     * @test read
     */
    public function test_read_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->create();

        $dbCategoryAttribute = $this->categoryAttributeRepo->find($categoryAttribute->id);

        $dbCategoryAttribute = $dbCategoryAttribute->toArray();
        $this->assertModelData($categoryAttribute->toArray(), $dbCategoryAttribute);
    }

    /**
     * @test update
     */
    public function test_update_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->create();
        $fakeCategoryAttribute = factory(CategoryAttribute::class)->make()->toArray();

        $updatedCategoryAttribute = $this->categoryAttributeRepo->update($fakeCategoryAttribute, $categoryAttribute->id);

        $this->assertModelData($fakeCategoryAttribute, $updatedCategoryAttribute->toArray());
        $dbCategoryAttribute = $this->categoryAttributeRepo->find($categoryAttribute->id);
        $this->assertModelData($fakeCategoryAttribute, $dbCategoryAttribute->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_category_attribute()
    {
        $categoryAttribute = factory(CategoryAttribute::class)->create();

        $resp = $this->categoryAttributeRepo->delete($categoryAttribute->id);

        $this->assertTrue($resp);
        $this->assertNull(CategoryAttribute::find($categoryAttribute->id), 'CategoryAttribute should not exist in DB');
    }
}

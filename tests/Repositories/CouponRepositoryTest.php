<?php namespace Tests\Repositories;

use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CouponRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var VoucherRepository
     */
    protected $couponRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->couponRepo = \App::make(VoucherRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_coupon()
    {
        $coupon = factory(Voucher::class)->make()->toArray();

        $createdCoupon = $this->couponRepo->create($coupon);

        $createdCoupon = $createdCoupon->toArray();
        $this->assertArrayHasKey('id', $createdCoupon);
        $this->assertNotNull($createdCoupon['id'], 'Created Coupon must have id specified');
        $this->assertNotNull(Voucher::find($createdCoupon['id']), 'Coupon with given id must be in DB');
        $this->assertModelData($coupon, $createdCoupon);
    }

    /**
     * @test read
     */
    public function test_read_coupon()
    {
        $coupon = factory(Voucher::class)->create();

        $dbCoupon = $this->couponRepo->find($coupon->id);

        $dbCoupon = $dbCoupon->toArray();
        $this->assertModelData($coupon->toArray(), $dbCoupon);
    }

    /**
     * @test update
     */
    public function test_update_coupon()
    {
        $coupon = factory(Voucher::class)->create();
        $fakeCoupon = factory(Voucher::class)->make()->toArray();

        $updatedCoupon = $this->couponRepo->update($fakeCoupon, $coupon->id);

        $this->assertModelData($fakeCoupon, $updatedCoupon->toArray());
        $dbCoupon = $this->couponRepo->find($coupon->id);
        $this->assertModelData($fakeCoupon, $dbCoupon->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_coupon()
    {
        $coupon = factory(Voucher::class)->create();

        $resp = $this->couponRepo->delete($coupon->id);

        $this->assertTrue($resp);
        $this->assertNull(Voucher::find($coupon->id), 'Coupon should not exist in DB');
    }
}

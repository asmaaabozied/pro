<?php

namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\CouponDataTable;
use App\Http\Requests;
// use App\Models\Image;
use App\Models\CouponImage;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;

use App\Repositories\CouponRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;
// use App\Models\CouponDetail;

class CouponController extends CustomizedAppBaseController
{
    /** @var  CouponRepository */
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        parent::__construct();
        $this->couponRepository = $couponRepo;
    }

    public function index(CouponDataTable $couponDataTable){
        return $couponDataTable->render('coupons.index');
    }

    
    public function create(){
        
        return view('coupons.create');
    }

    
    public function store(CreateCouponRequest $request){
        $input = $request->all();

        $coupon = $this->couponRepository->create($input);

        if($coupon != false){
            Flash::success('Coupon saved successfully.');
        }
        return redirect(route('coupons.index'));
    }


    public function show($id){
        $coupon = $this->couponRepository->find($id);
        // $coupon->with("couponDetails");
        if (empty($coupon)) {
            Flash::error('Coupon not found');
            return redirect(route('coupons.index'));
        }
        // $coupon_details = CouponDetail::where('coupon_id', $id)->get();
        // return view('coupons.show',compact('coupon', 'coupon_details'));

        return view('coupons.show',compact('coupon'));

    }
    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');
            return redirect(route('coupons.index'));
        }
        // $coupon_details = CouponDetail::where('coupon_id', $id)->get();
        // return view('coupons.edit',compact('coupon', 'coupon_details'));
        return view('coupons.edit',compact('coupon'));

    }
    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }

        $coupon = $this->couponRepository->update($request->all(), $id);

        Flash::success('Coupon updated successfully.');

        return redirect(route('coupons.index'));
    }

    public function destroy($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }

        $this->couponRepository->delete($id);

        Flash::success('Coupon deleted successfully.');

        return redirect(route('coupons.index'));
    }
    public function deleteCouponImage() {
        $id = $_POST['id'];
        $object = CouponImage::find($id);
        $object->delete();
        exit(true);
    }
}

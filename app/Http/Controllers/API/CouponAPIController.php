<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Core\Controllers\APIs\BaseAPI;
use App\Models\Coupon;
use App\Models\Voucher;
use App\Models\Cart;
use App\Models\Product;

use App\Http\Resources\CouponResource;
use App\Http\Resources\VoucherResource;

// use App\Models\CouponDetail;
use App\Models\CouponLikes;
use App\Models\CouponFavs;
use App\Models\CouponOrders;
use App\Repositories\CouponRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use DB;
use  App\Models\Store;
use  App\Models\Category;





class CouponAPIController extends AppBaseController
{
    protected $language;
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo){
        $this->couponRepository = $couponRepo;
        $this->language = (!empty(request()->header('Accept-Language')) ) ? request()->header('Accept-Language') :'en';
    }

    
    function responseJson($status,$message,$data=null){
        $response=['status'=>$status,'message'=>$message,'data'=>$data];
        return response()->json($response);
    }


    public function index(Request $request){
        $lang=$this->language;
        $title = 'title_'.$lang.' AS title';
        $description = 'description_'.$lang.' AS description';

        $cond=[];
        if(!empty($request->category_id)) $cond[]=['category_id' ,$request->category_id];
        if(!empty($request->city_id)) $cond[]=['city_id' ,$request->city_id];
        if(!empty($request->store_id)) $cond[]=['store_id' ,$request->store_id];
        
        if(!empty($request->featured)) $cond[]=['featured' ,$request->featured];
        if(!empty($request->inslider)) $cond[]=['inslider' ,$request->inslider];
        // $order_date=(!empty($request->order_date))?$request->order_date :'ASC';
        $limit=(!empty($request->limit))?$request->limit :10;
        $coupons = Coupon::when($request->title, function ($q) use ($request) {
                return $q->where('title_ar','like', '%' . $request->title . '%')
                ->orWhere('title_en','like', '%' . $request->title . '%');;
            })
        // ->with(['couponDetail'=>function($query)use($title){
        //         $query->select('id','coupon_id',$title,'discount',
        //                        'start_at','end_at','old_price','new_price', 
        //                        DB::raw('(DATEDIFF(end_at ,start_at) * 24*60*60 )AS time_diff_seconds') )
        //                        ->whereDate('end_at', '>=', date('Y-m-d'))
        //                        ->orderBy('start_at')
        //                        ->orderBy('end_at');
        //    }])
        ->where($cond)
        ->where('active' , 1)
        ->select('id',$title ,$description ,'city_id','store_id','category_id','active','view', 'featured' ,'inslider',
                 'city_id', 'store_id', 'category_id', 'start_at', 'valid_to', 'code',
                  'count', 'usage', 'discount_rate','created_at')
        // ->orderby('date',$order_date)
        ->with(['store'=>function($query){$query->select('id','image');}])
        ->withCount(['couponLikes' ,'couponFavs','couponRating'])
        ->paginate($limit);
        //return   $this->responseJson(200,'success',$coupons);
        return $this->sendResponse($coupons,trans('coupons.messages.retrieved'));

    }

    public function index_home(Request $request){
        $lang=$this->language;
        $title = 'title_'.$lang.' AS title';
        $description = 'description_'.$lang.' AS description';
        $name = 'name_'.$lang.' AS name';

        $cond=[];
        if(!empty($request->city_id)) $cond[]=['city_id' ,$request->city_id];

        $coupons_inslider = Coupon::where('active' , 1)->where($cond)
                ->with(['store'=>function($query){$query->select('id','image');}])
                ->where('inslider',1)
                ->where('start_at', '<=', date("Y-m-d"))
                ->where('valid_to', '>=', date("Y-m-d"))
                ->select('id',$title ,$description ,'city_id','store_id','start_at', 'valid_to', 'code',
                        'count', 'usage', 'discount_rate','created_at')
                ->get();

        $coupons_featured = Coupon::where('active' , 1)->where($cond)
                ->with(['store'=>function($query){$query->select('id','image');}])
                ->where('featured',1)
                ->where('start_at', '<=', date("Y-m-d"))
                ->where('valid_to', '>=', date("Y-m-d"))
                ->select('id',$title ,$description ,'city_id','store_id','category_id','view','city_id','store_id',
                        'category_id', 'start_at', 'valid_to', 'code','count', 'usage', 'discount_rate','created_at')
                ->get();
        $CouponData=Coupon::where('active' , 1)->select('store_id','category_id');
        $CouponStore=$CouponData->pluck('store_id')->toArray();
        $stores_ids=array_values(array_unique( $CouponStore));

        $stores=Store::select('id',$name,'image')->whereIn('id',$stores_ids)->latest()->get();

        return $this->sendResponse([ 'stores' =>$stores  ,'coupons_slider'=>$coupons_inslider ,'coupons_featured'=>$coupons_featured  ],trans('coupons.messages.retrieved'));

    }

    public function get_coupon_cats_stores(Request $request){
        $lang=$this->language;
        $title = 'title_'.$lang.' AS title';
        $description = 'description_'.$lang.' AS description';
        $name = 'name_'.$lang.' AS name';
        
        $CouponData=Coupon::where('active' , 1)->select('store_id','category_id');
        $couponCat= $CouponData->pluck('category_id')->toArray();
        $CouponStore=$CouponData->pluck('store_id')->toArray();
        $stores_ids=array_values(array_unique( $CouponStore));
        $categories_ids=array_values(array_unique( $couponCat));

        $stores=Store::select('id',$name,'image')->whereIn('id',$stores_ids)->latest()->get();
        $categories=Category::select('id',$title,'image')->whereIn('id',$categories_ids)->get();

        return $this->sendResponse([ 'stores' =>$stores , 'categories'=>$categories],trans('coupons.messages.retrieved'));

    }

    // public function index(Request $request)
    // {
    //     $paginate = 8;
    //     if(!empty($request->input('paginate')) && intval($request->input('paginate') > 0)) {
    //         $paginate = intval($request->input('paginate'));
    //     }

    //     $coupons = $this->couponRepository->lists($paginate);

    //     $data = Coupon::hydrate($coupons['data']);
    //     // dd($data );
    //     $data = CouponResource::toArray($data, $this->language);
    //     $coupons['data'] = $data;

    //     return $this->sendResponse($coupons, trans('coupons.messages.retrieved'));
    // }

    public function get_coupon($id){
        $lang=$this->language;
        $imageBasePath=asset('');
        $title = 'title_'.$lang.' AS title';
        $description = 'description_'.$lang.' AS description';
        $name = 'name_'.$lang.' AS name';


        $limit=(!empty($request->limit))?$request->limit :10;
        
        $coupon = Coupon::with(
            [
            // 'couponDetail'=>function($query)use($title){
            //  $query->select('id','coupon_id',$title,'discount',
            //                 'start_at','end_at','old_price','new_price',
            //                 DB::raw('(DATEDIFF(end_at ,start_at) * 24*60*60 )AS time_diff_seconds') )
            //                 ->whereDate('end_at', '>=', date('Y-m-d'))
            //                 ->orderBy('start_at')
            //                 ->orderBy('end_at');
            // },
        'store'=>function($query)use($name,$description){
            $query->select('id',$name, $description,'image','phone','lat','long');
       }
    //    ,'images'=>function($query)use($name,$description){$query->select('coupon_id','image');}
        ,'city'=>function($query)use($name){$query->select('id',$name);}
       ])
        ->select('id',$title ,$description,'city_id','store_id','category_id','active','view', 'featured' ,'inslider',
                'city_id', 'store_id', 'category_id', 'start_at', 'valid_to', 'code',
                'count', 'usage', 'discount_rate','created_at')
        // ->withCount(['couponLikes' ,'couponFavs','couponRating'])
        ->where('id' , $id)
        ->where('active' , 1)
        ->first();

        // if(!empty($coupon)){
        //     $coupon->is_fav =false;
        //     $coupon->is_liked =false;

        //     // covert image Array to 
        //     if($coupon->images){
        //         $images_arr=[];
        //         $coupon_images=$coupon->images->pluck('image')->toArray();
        //         foreach ($coupon_images as $key => $value) {$images_arr[]=$imageBasePath.$value;}
        //         $coupon->images_arr= $images_arr;
        //     }
        // }
        // if(!empty(auth('api')->user()) && !empty($coupon)){
        //     $user_id=auth('api')->user()->id;
        //     $coupon->is_liked=$coupon->isLiked($user_id);
        //     $coupon->is_fav=$coupon->isFav($user_id);
        // }

        // Update Views of Coupons
        if(!empty($coupon)){
            Coupon::where('id',$coupon->id)->increment('view');

            $coupon = $coupon->toArray();
            $coupon['city']=(!empty($coupon['city']['name']))? $coupon['city']['name']:'';
            unset($coupon['images']);
            return $this->sendResponse($coupon,trans('coupons.messages.retrieved'));
        }else{
            return $this->sendError(trans('coupons.messages.not_found'));
        }
    }
    public function like_coupon(Request $request){
        $rules=[
            'type' => 'required|string',
            'coupon_id' => 'required|exists:coupons,id|int',
        ];
        $input = $request->only('type','coupon_id');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {//$validator->errors()->all()
            // return response()->json(['status' => 422, 'message' => $validator->errors()]);
            return $this->sendError(trans('common.no_data'));

        }
        $user_id=request()->user()->id;
        $coupon_id=$request->coupon_id;
        $couponLikes=CouponLikes::where('user_id',$user_id)->where('coupon_id',$coupon_id)->first();
        if($request->type=='like'){
            $createdCouponLike=$couponLikes;
            if(empty($couponLikes)){
                $createdCouponLike=CouponLikes::create(['user_id'=>$user_id , 'coupon_id'=>$coupon_id]);
            }
            return $this->sendResponse($createdCouponLike,trans('coupons.messages.liked'));

        }elseif ($request->type=='dislike'){
            if(!empty($couponLikes)){
                $couponLikes->delete();
            }
            return $this->sendResponse([],trans('coupons.messages.disliked'));

       }
    }

    public function fav_coupon(Request $request){
        $rules=[
            'type' => 'required|string',
            'coupon_id' => 'required|exists:coupons,id|int',
        ];
        $input = $request->only('type','coupon_id');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {//$validator->errors()->all()
            // return response()->json(['status' => 422, 'message' => $validator->errors()]);
            return $this->sendError(trans('common.no_data'));
        }
        $user_id=request()->user()->id;
        $coupon_id=$request->coupon_id;
        $couponFavs=CouponFavs::where('user_id',$user_id)->where('coupon_id',$coupon_id)->first();
        if($request->type=='fav'){
            $createdCouponFav=$couponFavs;
            if(empty($couponFavs)){
                $createdCouponFav=CouponFavs::create(['user_id'=>$user_id , 'coupon_id'=>$coupon_id]);
            }
            return $this->sendResponse($createdCouponFav,trans('coupons.messages.fav'));

        }elseif ($request->type=='notfav'){
            if(!empty($couponFavs)){
                $couponFavs->delete();
            }
            return $this->sendResponse([],trans('coupons.messages.notfav'));

       }
    }

    public function user_favs(){
        $user_id=request()->user()->id;
        $lang=$this->language;
        $title = 'title_'.$lang.' AS title';
        $description = 'description_'.$lang.' AS description';

        $coupon_Favids = CouponFavs::select('coupon_id')
        ->where('user_id' , $user_id)
        ->pluck('coupon_id')->toArray();
        
        $coupons=[];
        if(count($coupon_Favids)>0){
            $coupons = Coupon::
            // with(['couponDetail'=>function($query)use($title){
            //         $query->select('id','coupon_id',$title,'discount',
            //                     'start_at','end_at','old_price','new_price', 
            //                     DB::raw('(DATEDIFF(end_at ,start_at) * 24*60*60 )AS time_diff_seconds') )
            //                     ->whereDate('end_at', '>=', date('Y-m-d'))
            //                     ->orderBy('start_at')
            //                     ->orderBy('end_at');
            // }])
            whereIn('id',$coupon_Favids)
            ->where('active' , 1)
            ->select('id',$title ,$description,'city_id','store_id','category_id','active','view', 'featured' ,'inslider',
                    'city_id', 'store_id', 'category_id', 'start_at', 'valid_to', 'code',
                    'count', 'usage', 'discount_rate','created_at')
            // ->orderby('date',$order_date)
            ->withCount(['couponLikes' ,'couponFavs','couponRating'])
            ->get();
        }


        // Update Views of Coupons
        return $this->sendResponse($coupons,trans('coupons.messages.retrieved'));
    }

    public function order_coupon(Request $request){
        // $rules=[
        //     'coupon_id' => 'required|exists:coupons,id|int',
        //     'coupon_details_id' => 'required|exists:coupon_details,id|int',
        // ];
        // $input = $request->only('coupon_id','coupon_details_id');
        // $validator = Validator::make($input, $rules);
        // if ($validator->fails()) {//$validator->errors()->all()
        //     return response()->json(['status' => 422, 'message' => $validator->errors()->all()]);
        //     // return $this->sendError(trans('common.no_data'));
        // }
        // $user_id=request()->user()->id;
        // $coupon_id=$request->coupon_id;
        // $coupon_details_id=$request->coupon_details_id;

        // $couponOrders=CouponOrders::where('user_id',$user_id)
        //                             ->where('coupon_id',$coupon_id)
        //                             ->where('coupon_details_id', $coupon_details_id)
        //                             ->first();
        // if(!empty($couponOrders)){
        //     return $this->sendError(trans('coupons.messages.ordered_before'));
        // }
        // else{
        //     $coupon_detail = CouponDetail::where('coupon_id', $coupon_id)
        //                             ->where('id', $coupon_details_id)->first();
        //     if(empty($coupon_detail)){
        //         return $this->sendError(trans('common.no_data'));
        //     }                      
        //     // dd($coupon_detail);
        //     $createdCouponOrder=CouponOrders::create(['user_id'=>$user_id ,
        //      'coupon_id'=>$coupon_detail->coupon_id ,
        //      'coupon_details_id'=>$coupon_detail->id,
        //      'price' => $coupon_detail->new_price]);
        //     return $this->sendResponse($createdCouponOrder,trans('coupons.messages.created'));
        // }

    }

    public function user_coupon(){
        // $imageBasePath=asset('');
        // $lang=$this->language;
        // $coupon_title = 'coupons.title_'.$lang.' AS coupon_title';
        // $coupon_details_title = 'coupon_details.title_'.$lang.' AS details_title';

        // $user_id=request()->user()->id;
        // $coupon_orders = CouponOrders::join('coupons','coupons.id' , 'coupon_orders.coupon_id')
        //         ->leftjoin('coupon_details','coupon_details.id' , 'coupon_orders.coupon_details_id')
        //         ->select('coupon_orders.id AS order_id','coupon_orders.coupon_id', 'coupon_orders.coupon_details_id',
        //                      'price', 'coupon_orders.created_at' , $coupon_title , 
        //                      $coupon_details_title , 
        //                      'coupon_details.old_price' ,'coupon_details.new_price','coupon_details.discount')
        //         ->where('user_id' , $user_id)
        //         ->get();
        // $coupon_ids= $coupon_orders->pluck("coupon_id");
        // $coupn_image=Coupon::whereIn('id',$coupon_ids)->get()->pluck('image','id');
        // // dd( $coupn_image);
        // $finalCoupons=[];
        // foreach ($coupon_orders as $key =>$value ) {
        //    $value->image =(!empty($coupn_image[$value->coupon_id]))?$coupn_image[$value->coupon_id]:'';
        //     $finalCoupons[]= $value;
        // }
        // return $this->sendResponse($finalCoupons,trans('coupons.messages.retrieved'));
    }

    public function validateVoucherCoupon(Request $data){
        $resultData;
        $result=false;
        $user =auth()->user();
        $voucher = Voucher::where('deleted_at', null)->where('type', 'Orders')
                        ->whereDate('start_date', '<=', date('Y-m-d'))
                        ->whereDate('end_date', '>=', date('Y-m-d'))
                        ->where('code', $data['code'])
                        ->whereColumn('count', '>', 'usage')
                        ->first();
        if(!empty($voucher)){
            $status = User::find($user->id)->validateVoucher($voucher->id);
            $result= ($status == "false")? false : $voucher;
        }
        if($result != false){
            $resultData=VoucherResource::toArray($voucher, $this->language);
            $resultData['type']='voucher';
            //return $this->sendResponse($resultData, trans('voucher.messages.valid'));
        }else{
            $coupon = Coupon::where('deleted_at', null)
                        ->whereDate('start_at', '<=', date('Y-m-d'))
                        ->whereDate('valid_to', '>=', date('Y-m-d'))
                        ->where('code', $data['code'])
                        ->whereColumn('count', '>', 'usage')
                        ->first();
                        // dd( $coupon->id);
            if(!empty($coupon)){
                $status = User::find($user->id)->validateCoupon($coupon->id);
                $result= ($status == "false")? false : $coupon;
            }
            if($result != false){
                $resultData=CouponResource::toArray($coupon, $this->language);
                $resultData['type']='coupon';
               //return $this->sendResponse( $resultData, trans('coupons.messages.valid'));
            }else{
                return $this->sendError(trans('coupons.messages.not_valid'));
            }
        }

        //calculate coupon/voucher discount
        //Get Products In cart And in this store
        $store_id=$resultData['store_id'];
        $rate=$resultData['rate'];
        $cart  = Cart::where('deleted_at', null)->whereNull('checked_out')
        ->where('user_id', $user->id)
        ->select('id')
        ->with(['items'])
        ->first();
        if( empty($cart) || count($cart->items)==0){
            return $this->sendError(trans('common.no_data_cart'));
        }
        $product_ids_Arr=$cart->items->pluck('product_id');
        $product=Product::select('id')->where('store_id' , $store_id)->whereIn('id',$product_ids_Arr)->get();
        if(empty($product)){
            return $this->sendError(trans('common.no_products_voucher_coupon'));
        }
        $productWithVoucherCouponsArr=$product->pluck('id')->toArray();
       $totalDiscount=0;
       $finalRes=[];
        foreach ($cart->items as  $value) {
            $product_id=$value->product_id;

            if(in_array($product_id ,$productWithVoucherCouponsArr)){
                $quantity = floatval($value->quantity);
                $price = floatval($value->price);
                $prodTotal=$quantity * $price;
                $discount=$prodTotal-($prodTotal*$rate/100);
                $totalDiscount=$totalDiscount+$discount;
                $finalRes[]=['product_id' =>$product_id ,'discount'=>$discount];
            }
        }

        $resultData['total_discount']=$totalDiscount;
        $resultData['discount_details']=$finalRes;
        return $this->sendResponse( $resultData, trans('common.coupon_voucher_valid',['type'=>$resultData['type']]));

    }

}
<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Models\Image;
use App\Repositories\BaseRepository;
use Laracasts\Flash\Flash;
use App\Models\CouponImage;

/**
 * Class CouponRepository
 * @package App\Repositories
 * @version July 22, 2020, 5:33 pm UTC
*/

class CouponRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title_ar',
        'title_en',
        // 'discount',
        // 'start_at',
        // 'end_at',
        'description_ar',
        'description_en',
        // 'old_price',
        // 'description',
        // 'new_price',
        'view',
        'image',
        'active',
        'featured',
        'inslider',
        'store_id',
        'city_id',
        'category_id',
        'description',
        'image_id',
        'start_at',
        'valid_to',
        'code',
        'count',
        // 'usage',
        'discount_rate',
    ];

    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('coupons', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coupon::class;
    }

    public function lists($paginate = 8)
    {
        $query = $this->model->newQuery()->where('deleted_at', null)->where('active', true);
        return $query->paginate($paginate)->toArray();
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Coupon|boolean
     */
    public function create($input){
        // dd($input);
        $images = [];
        if (request()->hasFile('image')) {
            foreach (request()->file('image') as $key => $image) {
                $destinationPath = 'storage/Coupons/images';
                $file_info = getimagesize($image);
                if (empty($file_info)) { // No Image?
                    Flash::error(trans('common.messages.valid_image'));
                    return false;
                }
                $file = $image;
                $attach = $destinationPath . '/' . rand() . '-coupons-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, ($attach));
                $images[$key]['image'] = trim($attach);
            }
        } else {
            Flash::error(trans('common.messages.required_image'));
            return false;
        }
        unset($input['images']);
        $input['image'] = (isset($images[0]['image']))? $images[0]['image'] : null;
        // (isset($images[0]['image']))? $images[0]['main'] = true : null;

        $coupon = new Coupon();
        $coupon->fill($input)->save();
        
        // foreach ($images as $key => $image){
        //     $image['imageable_id'] = $coupon->id;
        //     $image['imageable_type'] = "Copoun";
        //     $coupon_image = new Image();
        //     $coupon_image->fill($image)->save();
        // }
        foreach ($images as $key => $image){
            $image['coupon_id'] = $coupon->id;
            $coupon_image = new CouponImage();
            $coupon_image->fill($image)->save();
        }
        
        
        // $detailsArr=[];
        // foreach ( $input['details'] as  $detail){
        //     $detail['discount']=100 /(intval( $detail['old_price']/$detail['new_price']));
        //     $detailsArr[]= $detail;
        // }
        // dd($detailsArr);
        //$coupon->couponDetail()->createMany($detailsArr);
        //$coupon->couponDetail()->save($detailsArr);
        
        return $coupon;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|boolean
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {

        $images = [];
        if (request()->hasFile('image')) {
            foreach (request()->file('image') as $key => $image) {
                $destinationPath = 'storage/Coupons/images';
                $file_info = getimagesize($image);
                if (empty($file_info)) { // No Image?
                    Flash::error(trans('common.messages.valid_image'));
                    return false;
                }
                $file = $image;
                $attach = $destinationPath . '/' . rand() . '-coupons-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, ($attach));
                $images[$key]['image'] = trim($attach);
            }
        }
        unset($input['image']);
        $coupon = Coupon::find($id);
        $coupon->fill($input)->save();
        // foreach ($images as $key => $image){
        //     $image['imageable_id'] = $coupon->id;
        //     $coupon_image = new Image();
        //     $coupon_image->fill($image)->save();
        // }
        foreach ($images as $key => $image){
            $image['coupon_id'] = $coupon->id;
            $coupon_image = new CouponImage();
            $coupon_image->fill($image)->save();
        }
        return $coupon;
    }
}

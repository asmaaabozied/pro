<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', trans("cart.fields.user_id")) !!}
    <select class="form-control select2" name="user_id" id="user_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($users as $id => $user)
            <option value="{{$id}}" {{($id == @$cart->user_id)? 'Selected' : ''}}>{{$user}}</option>
        @endforeach
    </select>
</div>

<!-- Status Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.status_help') }}"></i> &nbsp;{!! Form::label('status', trans('cart.fields.status')) !!}<br/>
    <select class="form-control select2" name="status" id="status">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('cart.cart_status') as $color => $status)
            <option value="{{$status}}" {{($status == @$cart->status)? 'Selected' : ''}}>{{$status}}</option>
        @endforeach
    </select>
</div>

<!-- Discount Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.discount_help') }}"></i> &nbsp;{!! Form::label('discount', trans('cart.fields.discount')) !!}<br/>
    <input type="radio" name="discount_type" id="discount_type" value="coupon" {{(@$cart->order->discount_type == 'coupon')? 'checked' : ''}}> {{trans('cart.fields.coupon')}} <br/>
</div>

<!-- Coupon Field -->
<div class="form-group col-sm-3" id="coupon" style="display: {{(@$cart->order->discount_type == 'coupon')? 'display' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.coupons_help') }}"></i> &nbsp;{!! Form::label('coupons', trans("cart.fields.coupons")) !!}
    <select class="form-control select2" name="coupon">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($coupons as $id => $coupon)
            <option value="{{$id}}">{{$coupon}}</option>
        @endforeach
    </select>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('carts.list')
        <a href="{{ route('carts.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
</div>


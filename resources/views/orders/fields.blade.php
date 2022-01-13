<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('order.fields.status_help') }}"></i> &nbsp;{!! Form::label('status', trans('order.fields.status')) !!}<br/>
    <select class="form-control select2" name="status" id="status">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('order.order_status') as $color => $status)
            <option value="{{$status}}" {{($status == @$order->status)? 'Selected' : ''}}>{{$status}}</option>
        @endforeach
    </select>
</div>
<input type="hidden" name="address_id" value="{{$order->address_id}}">
<input type="hidden" name="payment_type" value="{{$order->payment_type}}">

<div class="col-sm-12">
    <br/>
</div>
<!-- Order Field -->
<div class="form-group col-sm-12 text-center">
    <?php $name  = 'name_'.$language['admin'];
          $title = 'title_'.$language['admin'] ?>
    <table class="table table-hover table-bordered">
        <tbody>
            <tr>
                <td colspan="4" class="text-center field_show"><h4><b>{{trans('order.fields.user_id')}}</b></h4></td>
                <td colspan="4"><div class="col-sm-1">&nbsp;</div><a href="{{route('users.show', ['user' => $order->user_id])}}" target="_blank"><i class="fa fa-user"></i> {{$order->user->name}}</a></td>
            </tr>
            <tr>
                <td colspan="8" class="text-center field_show"><h4><b>{{trans('order.fields.address')}}</b></h4></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center field_show"><div class="field_show"><b>{{trans('address.fields.name')}}</b></div></td>
                <td colspan="2"><div class="col-sm-1">&nbsp;</div><a href="{{route('addresses.show', ['address' => $order->address_id])}}" target="_blank"> {{$order->address->name}}</a></td>
                <td colspan="2" class="text-center field_show"><div class="field_show"><b>{{trans('address.fields.mobile')}}</b></div></td>
                <td colspan="2"><div class="col-sm-1">&nbsp;</div><a href="{{route('addresses.show', ['address' => $order->address_id])}}" target="_blank"> {{$order->address->mobile}}</a></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center field_show"><div class="field_show"><b>{{trans('address.fields.country_id')}}</b></div></td>
                <td colspan="2"><div class="col-sm-1">&nbsp;</div><a href="{{route('countries.show', ['country' => $order->address->country_id])}}" target="_blank"><i class="fa fa-globe"></i> {{$order->address->country->$name}}</a></td>
                <td colspan="2" class="text-center field_show"><div class="field_show"><b>{{trans('address.fields.city_id')}}</b></div></td>
                <td colspan="2"><div class="col-sm-1">&nbsp;</div><a href="{{route('cities.show', ['city' => $order->address->city_id])}}" target="_blank"><i class="fa fa-globe"></i> {{$order->address->city->$name}}</a></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center field_show"><div class="field_show"><b>{{trans('address.fields.address')}}</b></div></td>
                <td colspan="6"><div class="col-sm-1">&nbsp;</div><a href="{{route('addresses.show', ['address' => $order->address_id])}}" target="_blank"> {{$order->address->address}}</a></td>
            </tr>
            <tr>
                <td colspan="8" class="text-center field_show"><h4><b>{{trans('order.fields.payment')}}</b></h4></td>
            </tr>
            <tr>
                <td class="text-center field_show"><div class="field_show"><b>{{trans('order.fields.shipping_cost')}}</b></div></td>
                <td><div class="col-sm-1">&nbsp;</div>{{$order->shipping_cost}}</td>
                <td class="text-center field_show"><div class="field_show"><b>{{trans('order.fields.cart_total')}}</b></div></td>
                <td><div class="col-sm-1">&nbsp;</div>{{$order->cart_total}}</td>
                <td class="text-center field_show"><div class="field_show"><b>{{trans('order.fields.coupon')}}</b></div></td>
                <td><div class="col-sm-1">&nbsp;</div>{{@$order->coupon->coupon->$title}}</td>
                <td class="text-center field_show"><div class="field_show"><b>{{trans('order.fields.discount')}}</b></div></td>
                <td><div class="col-sm-1">&nbsp;</div>{{$order->discount}}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center field_show"><div class="field_show"><b>{{trans('order.fields.total')}}</b></div></td>
                <td colspan="2"><div class="col-sm-1">&nbsp;</div>{{$order->total}}</td>
                <td colspan="2" class="text-center field_show"><div class="field_show"><b>{{trans('order.fields.payment_type')}}</b></div></td>
                <td colspan="2"><div class="col-sm-1">&nbsp;</div>{{$order->payment_type}}</td>
            </tr>
        </tbody>
    </table>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('orders.list')
        <a href="{{ route('orders.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['orders.edit', 'orders.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
</div>

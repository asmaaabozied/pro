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
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><a href="{{route('users.show', ['user' => $cart->user_id])}}" target="_blank"><i class="fa fa-user"></i> {{ $cart->user->name }}</a></div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.status_help') }}"></i> &nbsp;{!! Form::label('status', trans('cart.fields.status')) !!}<br/>
    <div class="field_show text-center" style="background: {{array_search($cart->status, trans('cart.cart_status'))}}"><div class="col-sm-1">&nbsp;</div> <span style="color: white">{{ $cart->status }}</span></div>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('carts.list')
        <a href="{{ route('carts.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
</div>

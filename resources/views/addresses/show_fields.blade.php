<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', 'User Id:') !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><a href="{{route('users.show', ['user' => $address->user_id])}}" target="_blank"><i class="fa fa-user"></i> {{$address->user->name}}</a></div>
</div>

<!-- Address Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.name_help') }}"></i> &nbsp;{!! Form::label('name', 'Address:') !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $address->name }}</div>
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.address_help') }}"></i> &nbsp;{!! Form::label('address', 'Address:') !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $address->address }}</div>
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.mobile_help') }}"></i> &nbsp;{!! Form::label('mobile', 'Mobile:') !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $address->mobile }}</div>
</div>

<?php $name = 'name_'.$language['admin'] ?>
<!-- Country Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.country_id_help') }}"></i> &nbsp;{!! Form::label('country_id', trans('address.fields.country_id')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $address->country->$name }}</div>
</div>

<!-- City Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.city_id_help') }}"></i> &nbsp;{!! Form::label('city_id', trans('address.fields.city_id')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $address->city->$name }}</div>
</div>

<!-- Main Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.main_help') }}"></i> &nbsp;{!! Form::label('main', trans('address.fields.main')) !!}<br/>
    <h4>
        @if($address->main)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('addresses.list')
        <a href="{{ route('addresses.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('addresses.edit')
        <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('addresses.delete')
        <a href="{{ route('addresses.destroy', $address->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>


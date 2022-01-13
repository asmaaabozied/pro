<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Subscription Id Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.store_id_help') }}"></i> &nbsp;{!! Form::label('store_id', trans('storeSubscription.fields.store_id')) !!}
    <?php $title = 'title_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeSubscription->subscription->$title }}</div>
</div>

<!-- Store Id Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.subscription_id_help') }}"></i> &nbsp;{!! Form::label('subscription_id', trans('storeSubscription.fields.subscription_id')) !!}
    <?php $name = 'name_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeSubscription->store->$name }}</div>
</div>

<!-- Actual Price Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.actual_price_help') }}"></i> &nbsp;{!! Form::label('actual_price', trans('storeSubscription.fields.actual_price')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeSubscription->actual_price }}</div>
</div>

<!-- Price Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.price_help') }}"></i> &nbsp;{!! Form::label('price', trans('storeSubscription.fields.price')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeSubscription->price }}</div>
</div>

<!-- Duration Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.duration_help') }}"></i> &nbsp;{!! Form::label('duration', trans('storeSubscription.fields.duration')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeSubscription->duration }}</div>
</div>

<!-- Subscribe Date Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.subscribe_date') }}"></i> &nbsp;{!! Form::label('created_at', trans('storeSubscription.fields.subscribe_date')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ date('d-m-Y', strtotime($storeSubscription->created_at)) }}</div>
</div>

<!-- Expire Date Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.expire_date_help') }}"></i> &nbsp;{!! Form::label('expire_date', trans('storeSubscription.fields.expire_date')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ date('d-m-Y', strtotime($storeSubscription->expire_date)) }}</div>
</div>

<!-- Active Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("storeSubscription.fields.active")) !!}
    <h4>
        @if($storeSubscription->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('storeSubscriptions.list')
        <a href="{{ route('storeSubscriptions.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
</div>


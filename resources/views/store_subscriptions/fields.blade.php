@if( !empty(request()->sub_id) && empty($stores_subscription[request()->sub_id]))
<ul class="alert alert-danger" style="list-style-type: none">
        <li>The selected subscription id is invalid.</li>
</ul>
@else
<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Store Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.store_id_help') }}"></i> &nbsp;{!! Form::label('store_id', trans('storeSubscription.fields.store_id')) !!}
    <select class="form-control select2" name="store_id" id="store_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($stores as $id => $store)
            <option value="{{$id}}" @if(!empty($storeSubscription) && $id == @$storeSubscription->subscription_id) Selected @endif >{{$store}}</option>
        @endforeach
    </select>
</div>
<!-- Store Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.subscription_id_help') }}"></i> &nbsp;{!! Form::label('subscription_id', trans('storeSubscription.fields.subscription_id')) !!}
    <select class="form-control select2 subscription" name="subscription_id" id="subscription_id"  @if( !empty( request()->sub_id) ) disabled @endif>
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($subscriptions as $id => $subscription)
            <option value="{{$id}}" 
                @if( !empty( request()->sub_id) && $id == request()->sub_id ) Selected
                @else
                    {{($id == @$storeSubscription->subscription_id)? Selected : ''}}
                @endif
            >
            {{$subscription}}
            </option>

        @endforeach
    </select>

    @if( !empty( request()->sub_id) ) <input hidden name="subscription_id" value="{{request()->sub_id}}" >@endif
    </div>

<!-- Price Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeSubscription.fields.price_help') }}"></i> &nbsp;{!! Form::label('price', trans('storeSubscription.fields.price')) !!}
    @if( !empty( request()->sub_id) ) 
        <input hidden name="subscription_id" value="{{$stores_subscription[request()->sub_id]->price}}" >
        <input disabled value="{{$stores_subscription[request()->sub_id]->price}}" >
    @else
        {!! Form::number('price', null, ['class' => 'form-control', 'min' => 0, 'step' => 0.1] ) !!}
    @endif

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('storeSubscriptions.list')
        <a href="{{ route('storeSubscriptions.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['storeSubscriptions.edit', 'storeSubscriptions.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('storeSubscriptions.delete')
        @if(isset($storeSubscription))
            <a href="{{ route('storeSubscriptions.destroy', $storeSubscription->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>
@endif
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', trans('address.fields.user_id')) !!}
    <select class="form-control select2" name="user_id" id="user_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($users as $id => $user)
            <option value="{{$id}}" {{($id == @$address->user_id)? 'Selected' : ''}}>{{$user}}</option>
        @endforeach
    </select>
</div>

<!-- Name Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.name_help') }}"></i> &nbsp;{!! Form::label('name', trans('address.fields.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.address_help') }}"></i> &nbsp;{!! Form::label('address', trans('address.fields.address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.mobile_help') }}"></i> &nbsp;{!! Form::label('mobile', trans('address.fields.mobile')) !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.country_id_help') }}"></i> &nbsp;{!! Form::label('country_id', trans('address.fields.country_id')) !!}
    <select class="form-control select2" name="country_id" id="country_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($countries as $id => $country)
            <option value="{{$id}}" {{($id == @$address->country_id)? 'Selected' : ''}}>{{$country}}</option>
        @endforeach
    </select>
</div>

<!-- City Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.city_id_help') }}"></i> &nbsp;{!! Form::label('city_id', trans('address.fields.city_id')) !!}
    <select class="form-control select2" name="city_id" id="city_id">
        @if(isset($address))
            <?php $name = 'name_'.$language['admin'] ?>
            <option selected value="{{$address->city_id}}">{{$address->city->$name}}</option>
        @else
            <option selected disabled>{{trans('common.select')}}</option>
        @endif
    </select>
</div>

<!-- Main Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('address.fields.main_help') }}"></i> &nbsp;{!! Form::label('main', trans("address.fields.main")) !!}<br/>
    <label>
        <input type="hidden" name="main" id="main" value="0" checked>
        <input type="checkbox" name="main" id="main" @if(@$address->main) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('addresses.list')
        <a href="{{ route('addresses.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['addresses.edit', 'addresses.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('addresses.delete')
        @if(isset($address))
            <a href="{{ route('addresses.destroy', $address->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

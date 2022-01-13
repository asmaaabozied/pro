
<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('city.fields.country_id_help') }}"></i> &nbsp;{!! Form::label('country_id', trans('city.fields.country_id')) !!}
    <select class="form-control select2" name="country_id" id="country_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($countries as $id => $item)
            <option value="{{$id}}" {{($id == @$city->country_id)? 'Selected' : ''}}>{{$item}}</option>
        @endforeach
    </select>
</div>

<!-- Name En Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('city.fields.name_en_help') }}"></i> &nbsp;{!! Form::label('name_en', trans('city.fields.name_en')) !!}
    {!! Form::text('name_en', null, ['class' => 'form-control', 'min' => 3]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'name_' . $system_language;
    $input_value = (isset($city))? $city->$input_name : ''
    ?>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('city.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("city.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Postal Code Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('city.fields.postal_code_help') }}"></i> &nbsp;{!! Form::label('postal_code', trans('city.fields.postal_code')) !!}
    {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('city.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("city.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$city->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('cities.list')
        <a href="{{ route('cities.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['cities.edit', 'cities.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('cities.delete')
        @if(isset($city))
            <a href="{{ route('cities.destroy', $city->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

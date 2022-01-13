{{--<div class="col-sm-12">--}}
{{--    <div class="col-sm-12" style="background: #3c8dbcab;">--}}
{{--        <h4 style="color: #222d32"><b>{{ trans('common.languages') }}</b></h4>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <br/>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group col-sm-12">--}}
{{--    <label for="en" class="control-label">--}}
{{--        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('common.active_languages_help') }}"></i> &nbsp;{{ trans('common.active_languages') }}--}}
{{--    </label>--}}

{{--    <div class="checkbox">--}}
{{--        <label>--}}
{{--            <input type="hidden" id="en" name="en" value="0" checked>--}}
{{--            <input type="checkbox" id="en" name="en" @if(@$country->en) checked @endif value = 1> {{ strtoupper('en') }}--}}
{{--        </label>--}}
{{--        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @foreach($system_languages as $system_language)--}}
{{--            <label>--}}
{{--                <input type="hidden" id="{{$system_language}}" name="{{$system_language}}" value="0" checked>--}}
{{--                <input type="checkbox" id="{{$system_language}}" name="{{$system_language}}" @if(@$country->$system_language) checked @endif value="1"> {{ strtoupper($system_language) }}--}}
{{--            </label>--}}
{{--            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</div>--}}

<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Name En Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.name_en_help') }}"></i> &nbsp;{!! Form::label('name_en', trans('country.fields.name_en')) !!}
    {!! Form::text('name_en', null, ['class' => 'form-control', 'minlength' => 3]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'name_' . $system_language;
    $input_value = (isset($country))? $country->$input_name : ''
    ?>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("country.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Key Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.key_help') }}"></i> &nbsp;{!! Form::label('key', trans('country.fields.key')) !!}
    {!! Form::text('key', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.code_help') }}"></i> &nbsp;{!! Form::label('code', trans('country.fields.code')) !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Shipping Cost Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.shipping_cost_help') }}"></i> &nbsp;{!! Form::label('shipping_cost', trans('country.fields.shipping_cost')) !!}
    {!! Form::number('shipping_cost', null, ['class' => 'form-control', 'min' => 0]) !!}
</div>

<!-- Delivery For 5K Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.delivery_for_5k_help') }}"></i> &nbsp;{!! Form::label('delivery_for_5k', trans('country.fields.delivery_for_5k')) !!}
    {!! Form::number('delivery_for_5k', null, ['class' => 'form-control', 'min' => 0]) !!}
</div>

<!-- Additional k Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.additional_k_help') }}"></i> &nbsp;{!! Form::label('additional_k', trans('country.fields.additional_k')) !!}
    {!! Form::number('additional_k', null, ['class' => 'form-control', 'min' => 0]) !!}
</div>


<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("country.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$country->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('countries.list')
        <a href="{{ route('countries.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['countries.edit', 'countries.create'])
        <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('countries.delete')
        @if(isset($country))
            <a href="{{ route('countries.destroy', $country->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

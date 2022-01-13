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
{{--            <input type="checkbox" id="en" name="en" @if(@$storeType->en) checked @endif value = 1> {{ strtoupper('en') }}--}}
{{--        </label>--}}
{{--        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @foreach($system_languages as $system_language)--}}
{{--            <label>--}}
{{--                <input type="hidden" id="{{$system_language}}" name="{{$system_language}}" value="0" checked>--}}
{{--                <input type="checkbox" id="{{$system_language}}" name="{{$system_language}}" @if(@$storeType->$system_language) checked @endif value=1> {{ strtoupper($system_language) }}--}}
{{--            </label>--}}
{{--            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="col-sm-12">--}}
{{--        <hr style="border-color: #3c8dbcab"/>--}}
{{--    <div class="col-sm-12" style="background: #3c8dbcab;">--}}
{{--        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <br/>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Type En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeType.fields.type_en_help') }}"></i> &nbsp;{!! Form::label('type_en', trans("storeType.fields.type_en")) !!}<br/>
    {!! Form::text('type_en', null, ['class' => 'form-control']) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'type_' . $system_language;
    $input_value = (isset($storeType))? $storeType->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeType.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("storeType.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeType.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("storeType.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$storeType->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('storeTypes.list')
        <a href="{{ route('storeTypes.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['storeTypes.edit', 'storeTypes.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
<!-- {{--    @can('storeTypes.delete')--}}
{{--        @if(isset($storeType))--}}
{{--            <a href="{{ route('storeTypes.destroy', $storeType->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>--}}
{{--        @endif--}}
{{--    @endcan--}} -->
</div>

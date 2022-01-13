<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.languages') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<div class="form-group col-sm-12">
    <label for="en" class="control-label">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('common.active_languages_help') }}"></i> &nbsp;{{ trans('common.active_languages') }}
    </label>

    <div class="form">
        <label>
            {{ strtoupper('en') }}
            @if($country->en)
                <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @foreach($system_languages as $system_language)
            <label>
                {{ strtoupper($system_language) }}
                @if($country->$system_language)
                    <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
                @else
                    <i style="color: red;" class="fa fa-lg fa-times"></i>
                @endif
            </label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
    </div>
</div>

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
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.name_en_help') }}"></i> &nbsp;{!! Form::label('name_en', trans('country.fields.name_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $country->name_en }}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'name_' . $system_language;
    $input_value = $country->$input_name;
    ?>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("country.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Key Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.key_help') }}"></i> &nbsp;{!! Form::label('key', trans('country.fields.key')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $country->key }}</div>
</div>

<!-- Code Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.code_help') }}"></i> &nbsp;{!! Form::label('code', trans('country.fields.code')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $country->code }}</div>
</div>

<!-- Shipping Cost Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.shipping_cost_help') }}"></i> &nbsp;{!! Form::label('shipping_cost', trans('country.fields.shipping_cost')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $country->shipping_cost }}</div>
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('country.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("country.fields.active")) !!}
    <h4>
        @if($country->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('countries.list')
        <a href="{{ route('countries.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('countries.edit')
        <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('countries.delete')
        <a href="{{ route('countries.destroy', $country->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>


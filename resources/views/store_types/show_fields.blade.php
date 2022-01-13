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
            @if($storeType->en)
                <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @foreach($system_languages as $system_language)
            <label>
                {{ strtoupper($system_language) }}
                @if($storeType->$system_language)
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

<!-- Type Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeType.fields.type_en_help') }}"></i> &nbsp;{!! Form::label('type_en', trans("storeType.fields.type_en")) !!}<br/>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeType->type_en }}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'type_' . $system_language;
    $input_value = $storeType->$input_name;
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeType.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("storeType.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Image Field -->
<!-- <div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeType.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('user.fields.image')) !!}
    <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
</div>
<div id="current_image" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>{{ trans('common.current_image') }}</b></h4>
            </div>
            <div class="modal-body text-center" id="data" style="display: block;">
                <img class="ImagePreview" src="{{ asset($storeType->image) }}" style="width: 100% !important; height: 100% !important;"/>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Active Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeType.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("storeType.fields.active")) !!}
    <h4>
        @if($storeType->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('storeTypes.list')
        <a href="{{ route('storeTypes.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('storeTypes.edit')
        <a href="{{ route('storeTypes.edit', $storeType->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('storeTypes.delete')
        <a href="{{ route('storeTypes.destroy', $storeType->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>



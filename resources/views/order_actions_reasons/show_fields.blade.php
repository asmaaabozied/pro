<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Type Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.type_help') }}"></i> &nbsp;{!! Form::label('type', trans('orderActionsReason.fields.type')) !!}<br/>
    <div class="field_show text-center" style="background: {{array_search($orderActionsReason->type, trans('orderActionsReason.types'))}}"> <span style="color: white">{{ $orderActionsReason->type }}</span></div>
</div>

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('orderActionsReason.fields.title_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$orderActionsReason->title_en}}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = $orderActionsReason->$input_name;
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("orderActionsReason.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("orderActionsReason.fields.active")) !!}
    <h4>
        @if($orderActionsReason->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('orderActionsReasons.list')
        <a href="{{ route('orderActionsReasons.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('orderActionsReasons.edit')
        <a href="{{ route('orderActionsReasons.edit', $orderActionsReason->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('orderActionsReasons.delete')
        <a href="{{ route('orderActionsReasons.destroy', $orderActionsReason->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>
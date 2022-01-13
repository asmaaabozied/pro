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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.name_en_help') }}"></i> &nbsp;{!! Form::label('name_en', trans('categoryAttribute.fields.name_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$categoryAttribute->name_en}}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'name_' . $system_language;
    $input_value = $categoryAttribute->$input_name;
    ?>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("categoryAttribute.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Category Id Field -->
<div class="form-group col-sm-2">
    <?php $input_name = 'title_' . $language['admin']; ?>
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("categoryAttribute.fields.category_id")) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{@$categoryAttribute->category->$input_name}}</div>
</div>

<!-- Name En Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.unit_en_help') }}"></i> &nbsp;{!! Form::label('unit_en', trans('categoryAttribute.fields.unit_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$categoryAttribute->unit_en}}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'unit_' . $system_language;
    $input_value = $categoryAttribute->$input_name;
    ?>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("categoryAttribute.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("categoryAttribute.fields.active")) !!}
    <h4>
        @if($categoryAttribute->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.editors') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('categoryAttribute.fields.description_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $categoryAttribute->description_en ?></div>
</div>

@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $categoryAttribute->$input_name;
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("categoryAttribute.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>
    </div>
@endforeach


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('categoryAttributes.list')
        <a href="{{ route('categoryAttributes.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('categoryAttributes.edit')
        <a href="{{ route('categoryAttributes.edit', $categoryAttribute->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('categoryAttributes.delete')
        <a href="{{ route('categoryAttributes.destroy', $categoryAttribute->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>

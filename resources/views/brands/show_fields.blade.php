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

{{--    <div class="form">--}}
{{--        <label>--}}
{{--            {{ strtoupper('en') }}--}}
{{--            @if($brand->en)--}}
{{--                <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>--}}
{{--            @else--}}
{{--                <i style="color: red;" class="fa fa-lg fa-times"></i>--}}
{{--            @endif--}}
{{--        </label>--}}
{{--        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @foreach($system_languages as $system_language)--}}
{{--            <label>--}}
{{--                {{ strtoupper($system_language) }}--}}
{{--                @if($brand->$system_language)--}}
{{--                    <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>--}}
{{--                @else--}}
{{--                    <i style="color: red;" class="fa fa-lg fa-times"></i>--}}
{{--                @endif--}}
{{--            </label>--}}
{{--            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @endforeach--}}
{{--    </div>--}}
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

<!-- Category Field -->
<div class="form-group col-sm-2">
    <?php $input_name = 'title_' . $language['admin']; ?>
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("brand.fields.category_id")) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$brand->category->$input_name}}</div>
</div>

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('brand.fields.title_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$brand->title_en}}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = $brand->$input_name;
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("brand.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("brand.fields.active")) !!}
    <h4>
        @if($brand->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Image Field -->
{{--<div class="form-group col-sm-2">--}}
{{--    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('brand.fields.image')) !!}--}}
{{--    <div class="form-group">--}}
{{--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="current_image" class="modal fade" role="dialog">--}}
{{--    <div class="modal-dialog">--}}
{{--        <!-- Modal content-->--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                <h4 class="modal-title"><b>{{ trans('common.current_image') }}</b></h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body text-center" id="data" style="display: block;">--}}
{{--                <img class="ImagePreview" src="{{ asset(@$brand->image) }}" style="width: 100% !important; height: 100% !important;"/>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <div>--}}
{{--                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="col-sm-12">
    <br/>
</div>

{{--<div class="col-sm-12">--}}
{{--        <hr style="border-color: #3c8dbcab"/>--}}
{{--    <div class="col-sm-12" style="background: #3c8dbcab;">--}}
{{--        <h4 style="color: #222d32"><b>{{ trans('common.editors') }}</b></h4>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <br/>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Description Field -->
{{--<div class="form-group col-sm-6 col-lg-6">--}}
{{--    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('brand.fields.description_en')) !!}--}}
{{--    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $brand->description_en ?></div>--}}
{{--</div>--}}

{{--@foreach($system_languages as $system_language)--}}
{{--    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $brand->$input_name;
    ?>--}}
{{--    <div class="form-group col-sm-6 col-lg-6">--}}
{{--        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("brand.fields.$input_name")) !!}--}}
{{--        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>--}}
{{--    </div>--}}
{{--@endforeach--}}


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('brands.list')
        <a href="{{ route('brands.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('brands.edit')
        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('brands.delete')
        <a href="{{ route('brands.destroy', $brand->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>

  {{-- <div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.languages') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
--}}
{{--<div class="form-group col-sm-12">--}}
{{--    <label for="en" class="control-label">--}}
{{--        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('common.active_languages_help') }}"></i> &nbsp;{{ trans('common.active_languages') }}--}}
{{--    </label>--}}

{{--    <div class="checkbox">--}}
{{--        <label>--}}
{{--            <input type="hidden" id="en" name="en" value="0" checked>--}}
{{--            <input type="checkbox" id="en" name="en" @if(@$brand->en) checked @endif value = 1> {{ strtoupper('en') }}--}}
{{--        </label>--}}
{{--        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @foreach($system_languages as $system_language)--}}
{{--            <label>--}}
{{--                <input type="hidden" id="{{$system_language}}" name="{{$system_language}}" value="0" checked>--}}
{{--                <input type="checkbox" id="{{$system_language}}" name="{{$system_language}}" @if(@$brand->$system_language) checked @endif value="1"> {{ strtoupper($system_language) }}--}}
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
<input hidden name='id' value="@if(isset($brand)) {{$brand->id}} @endif" />

<!-- Category Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("brand.fields.category_id")) !!}
    <select class="form-control select2" name="category_id" id="category_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($categories as $id => $category)
            <option value="{{$id}}" {{($id == @$brand->category_id)? 'Selected' : ''}}>{{$category }}</option>
        @endforeach
    </select>
</div>

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('brand.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = (isset($brand))? $brand->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("brand.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("brand.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$brand->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<div class="col-sm-12">
    <br/>
</div>

<!-- Image Field -->
{{--<div class="form-group col-sm-3">--}}
{{--    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('brand.fields.image')) !!}--}}
{{--    <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image" id="image" @if(! isset($brand)) required @endif>--}}
{{--</div>--}}
{{--<div class="form-group col-sm-3 ImagePreview" style="display: none">--}}

{{--    <label class="control-label">--}}
{{--        {{ trans('common.preview_button') }}--}}
{{--    </label>--}}
{{--    <br/>--}}
{{--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
{{--</div>--}}
{{--@if(@$brand != null)--}}
{{--    <div class="form-group col-sm-3" style="display: {{(isset($brand))? 'block' : 'none'}}">--}}

{{--        <label class="control-label">--}}
{{--            {{ trans('common.current_image') }}--}}
{{--        </label>--}}
{{--        <br/>--}}
{{--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
{{--    </div>--}}
{{--@endif--}}
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

<!--
<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.editors') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
-->
<!-- Description Field -->
{{--<div class="form-group col-sm-6 col-lg-6">--}}
{{--    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('brand.fields.description_en')) !!}--}}
{{--    {!! Form::textarea('description_en', null, ['class' => 'form-control', 'required' => true]) !!}--}}
{{--</div>--}}

{{--@foreach($system_languages as $system_language)--}}
{{--    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($brand))? $brand->$input_name : ''
    ?>--}}
{{--    <div class="form-group col-sm-6 col-lg-6">--}}
{{--        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('brand.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("brand.fields.$input_name")) !!}--}}
{{--        {!! Form::textarea($input_name, $input_value, ['class' => 'form-control', 'required' => true]) !!}--}}
{{--    </div>--}}
{{--@endforeach--}}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('brands.list')
        <a href="{{ route('brands.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['brands.edit', 'brands.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('brands.delete')
        @if(isset($brand))
            <a href="{{ route('brands.destroy', $brand->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

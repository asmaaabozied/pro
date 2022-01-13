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
{{--            <input type="checkbox" id="en" name="en" @if(@$slider->en) checked @endif value = 1> {{ strtoupper('en') }}--}}
{{--        </label>--}}
{{--        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @foreach($system_languages as $system_language)--}}
{{--            <label>--}}
{{--                <input type="hidden" id="{{$system_language}}" name="{{$system_language}}" value="0" checked>--}}
{{--                <input type="checkbox" id="{{$system_language}}" name="{{$system_language}}" @if(@$slider->$system_language) checked @endif value="1"> {{ strtoupper($system_language) }}--}}
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

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('slider.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = (isset($slider))? $slider->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("slider.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3]) !!}
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("slider.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$slider->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Link Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.link_help') }}"></i> &nbsp;{!! Form::label('link', trans('slider.fields.link')) !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Field -->
<div class="form-group col-sm-4">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.product_id_help') }}"></i> &nbsp;{!! Form::label('product_id', trans("slider.fields.product_id")) !!}
    <select class="form-control select2" name="product_id" id="product_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($products as $id => $product)
            <option value="{{$id}}" {{($id == @$slider->product_id)? 'Selected' : ''}}>{{$product}}</option>
        @endforeach
    </select>
</div>

<!-- Image Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('slider.fields.image')) !!}
    <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image" id="image" @if(! isset($slider)) required @endif>
</div>
<div class="form-group col-sm-2 ImagePreview" style="display: none">

    <label class="control-label">
        {{ trans('common.preview_button') }}
    </label>
    <br/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
</div>
@if(@$slider != null)
    <div class="form-group col-sm-2" style="display: {{(isset($slider))? 'block' : 'none'}}">

        <label class="control-label">
            {{ trans('common.current_image') }}
        </label>
        <br/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
@endif
<div id="current_image" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>{{ trans('common.current_image') }}</b></h4>
            </div>
            <div class="modal-body text-center" id="data" style="display: block;">
                <img class="ImagePreview" src="{{ asset(@$slider->image) }}" style="width: 100% !important; height: 100% !important;"/>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <br/>
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('slider.fields.description_en')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control']) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($slider))? $slider->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('slider.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("slider.fields.$input_name")) !!}
        {!! Form::textarea($input_name, $input_value, ['class' => 'form-control']) !!}
    </div>
@endforeach

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('sliders.list')
        <a href="{{ route('sliders.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['sliders.edit', 'sliders.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('sliders.delete')
        @if(isset($slider))
            <a href="{{ route('sliders.destroy', $slider->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

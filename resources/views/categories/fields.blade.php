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
{{--            <input type="checkbox" id="en" name="en" @if(@$category->en) checked @endif value = 1> {{ strtoupper('en') }}--}}
{{--        </label>--}}
{{--        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--        @foreach($system_languages as $system_language)--}}
{{--            <label>--}}
{{--                <input type="hidden" id="{{$system_language}}" name="{{$system_language}}" value="0" checked>--}}
{{--                <input type="checkbox" id="{{$system_language}}" name="{{$system_language}}" @if(@$category->$system_language) checked @endif value="1"> {{ strtoupper($system_language) }}--}}
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

<input hidden name='id' value="@if(isset($category)) {{$category->id}} @endif" />

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('category.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
        $input_name = 'title_' . $system_language;
        $input_value = (isset($category))? $category->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("category.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Parent Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.parent_help') }}"></i> &nbsp;{!! Form::label('parent', trans("category.fields.parent")) !!}
    <select class="form-control select2" name="parent" id="parent">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($categories as $id => $item)
            <option value="{{$id}}" {{($id == @$category->parent)? 'Selected' : ''}}>{{$item}}</option>
        @endforeach
    </select>
</div>

<!-- Menu Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.menu_help') }}"></i> &nbsp;{!! Form::label('menu', trans("category.fields.menu")) !!}<br/>
    <label>
        <input type="hidden" name="menu" id="menu" value="0" checked>
        <input type="checkbox" name="menu" id="menu" @if(@$category->menu) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Order Field -->
<div id="order_div" class="form-group col-sm-1" style="display: {{(@$category->menu)? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.order_help') }}"></i> &nbsp;{!! Form::label('order', trans('category.fields.order')) !!}
    {!! Form::number('order', null, ['class' => 'form-control','step' => 1, 'min' => 0]) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("category.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$category->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<div class="col-sm-12">
    <br/>
</div>

<!-- Image Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('category.fields.image')) !!}
    <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image" id="image" @if(! isset($category)) required @endif>
</div>
<div class="form-group col-sm-2 ImagePreview" style="display: none">

    <label class="control-label">
        {{ trans('common.preview_button') }}
    </label>
    <br/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
</div>
@if(@$category != null)
    <div class="form-group col-sm-2" style="display: {{(isset($category))? 'block' : 'none'}}">

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
                <img class="ImagePreview" src="{{ asset(@$category->image) }}" style="width: 50% !important; height: 50% !important;"/>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Icon Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.icon_help') }}"></i> &nbsp;{!! Form::label('icon', trans('category.fields.icon')) !!}
    <input type="file" onchange="readURL(this, 'IconPreview', 'IconPreview');" name="icon" id="icon" @if(! isset($category)) required @endif>
</div>
<div class="form-group col-sm-2 IconPreview" style="display: none">

    <label class="control-label">
        {{ trans('common.preview_button') }}
    </label>
    <br/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_icon"><i class="glyphicon glyphicon-eye-open"></i></button>
</div>
@if(@$category != null)
    <div class="form-group col-sm-2" style="display: {{(isset($category))? 'block' : 'none'}}">

        <label class="control-label">
            {{ trans('common.current_icon') }}
        </label>
        <br/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_icon"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
@endif
<div id="current_icon" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>{{ trans('common.current_icon') }}</b></h4>
            </div>
            <div class="modal-body text-center" id="data" style="display: block;">
                <img class="IconPreview" src="{{ asset(@$category->icon) }}" style="width: 50% !important; height: 50% !important;"/>
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('categories.list')
        <a href="{{ route('categories.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['categories.edit', 'categories.create'])
        <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('categories.delete')
        @if(isset($category) && $category->menu == false)
            <a href="{{ route('categories.destroy', $category->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

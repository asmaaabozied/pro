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
            @if($category->en)
                <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @foreach($system_languages as $system_language)
            <label>
                {{ strtoupper($system_language) }}
                @if($category->$system_language)
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

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('category.fields.title_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$category->title_en}}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = $category->$input_name;
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("category.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Parent Field -->
<div class="form-group col-sm-2">
    <?php $input_name = 'title_' . $language['admin']; ?>
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.parent_help') }}"></i> &nbsp;{!! Form::label('parent', trans("category.fields.parent")) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{@$category->category->$input_name}}</div>
</div>

<!-- Menu Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.menu_help') }}"></i> &nbsp;{!! Form::label('menu', trans("category.fields.menu")) !!}
    <h4>
        @if($category->menu)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Order Field -->
<div class="form-group col-sm-1" style="display: {{($category->menu)? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.order_help') }}"></i> &nbsp;{!! Form::label('order', trans('category.fields.order')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$category->order}}</div>
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("category.fields.active")) !!}
    <h4>
        @if($category->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<div class="col-sm-12">
    <br/>
</div>

<!-- Image Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('category.fields.image')) !!}
    <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
</div>
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
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('category.fields.icon_help') }}"></i> &nbsp;{!! Form::label('icon', trans('category.fields.icon')) !!}
    <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_icon"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
</div>
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


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('categories.list')
        <a href="{{ route('categories.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('categories.edit')
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('categories.delete')
        @if($category->menu == false)
            <a href="{{ route('categories.destroy', $category->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

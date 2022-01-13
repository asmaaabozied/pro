<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
<input hidden name='id' value="@if(isset($categoryAttribute)) {{$categoryAttribute->id}} @endif" />

<!-- Name En Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.name_en_help') }}"></i> &nbsp;{!! Form::label('name_en', trans('categoryAttribute.fields.name_en')) !!}
    {!! Form::text('name_en', null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'name_' . $system_language;
    $input_value = (isset($categoryAttribute))? $categoryAttribute->$input_name : ''
    ?>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("categoryAttribute.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Category Id Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("categoryAttribute.fields.category_id")) !!}
    <select class="form-control select2" name="category_id" id="category_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($categories as $id => $item)
            <option value="{{$id}}" {{($id == @$categoryAttribute->category_id)? 'Selected' : ''}}>{{$item}}</option>
        @endforeach
    </select>
</div>

<!-- Unit Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.unit_en_help') }}"></i> &nbsp;{!! Form::label('unit_en', trans('categoryAttribute.fields.unit_en')) !!}
    {!! Form::text('unit_en', null, ['class' => 'form-control', 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'unit_' . $system_language;
    $input_value = (isset($categoryAttribute))? $categoryAttribute->$input_name : ''
    ?>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("categoryAttribute.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control', 'required' => true]) !!}
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("categoryAttribute.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$categoryAttribute->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
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
    {!! Form::textarea('description_en', null, ['class' => 'form-control' ,'id'=>'summary-ckeditor', 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($categoryAttribute))? $categoryAttribute->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('categoryAttribute.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("categoryAttribute.fields.$input_name")) !!}
        {!! Form::textarea($input_name, $input_value, ['class' => 'form-control','id'=>'summaryckeditor' ,'required' => true]) !!}
    </div>
@endforeach


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('categoryAttributes.list')
        <a href="{{ route('categoryAttributes.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['categoryAttributes.edit', 'categoryAttributes.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('categoryAttributes.delete')
        @if(isset($categoryAttribute))
            <a href="{{ route('categoryAttributes.destroy', $categoryAttribute->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

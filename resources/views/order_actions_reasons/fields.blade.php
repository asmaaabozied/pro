<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Type Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.type_help') }}"></i> &nbsp;{!! Form::label('type', trans('orderActionsReason.fields.type')) !!}<br/>
    <select class="form-control select2" name="type" id="type">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('orderActionsReason.types') as $color => $type)
            <option value="{{$type}}" {{($type == @$orderActionsReason->type)? 'Selected' : ''}}>{{$type}}</option>
        @endforeach
    </select>
</div>

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('orderActionsReason.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = (isset($orderActionsReason))? $orderActionsReason->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("orderActionsReason.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Active Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('orderActionsReason.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("orderActionsReason.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$orderActionsReason->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('orderActionsReasons.list')
        <a href="{{ route('orderActionsReasons.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['orderActionsReasons.edit', 'orderActionsReasons.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('orderActionsReasons.delete')
        @if(isset($orderActionsReason))
            <a href="{{ route('orderActionsReasons.destroy', $orderActionsReason->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

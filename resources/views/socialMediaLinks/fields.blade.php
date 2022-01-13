<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('socialMediaLink.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php $input_name = 'title_' . $system_language;?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("socialMediaLink.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Icon Field -->
<div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.icon_help') }}"></i> &nbsp;{!! Form::label('icon', trans('socialMediaLink.fields.icon')) !!} &nbsp; <a href="https://fontawesome.com/icons" target="_blank"><i class="fa fa-external-link" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.more_icons') }}"></i></a>
    {!! Form::text('icon', null, ['class' => 'form-control']) !!}
</div>

<!-- Background Color Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.background_color_help') }}"></i> &nbsp;{!! Form::label('background_color', trans('socialMediaLink.fields.background_color')) !!} &nbsp; <a href="https://htmlcolorcodes.com" target="_blank"><i class="fa fa-external-link" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.more_icons') }}"></i></a>
    {!! Form::text('background_color', null, ['class' => 'form-control']) !!}
</div>

<!-- Class Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.class_help') }}"></i> &nbsp;{!! Form::label('class', trans('socialMediaLink.fields.class')) !!}
    {!! Form::text('class', null, ['class' => 'form-control']) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("socialMediaLink.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$socialMediaLink->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.link_help') }}"></i> &nbsp;{!! Form::label('class', trans('socialMediaLink.fields.link')) !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('socialMediaLink.fields.description_en')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control', 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($socialMediaLink))? $socialMediaLink->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("socialMediaLink.fields.$input_name")) !!}
        {!! Form::textarea($input_name, $input_value, ['class' => 'form-control', 'required' => true]) !!}
    </div>
@endforeach


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('socialMediaLinks.list')
        <a href="{{ route('socialMediaLinks.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['socialMediaLinks.edit', 'socialMediaLinks.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('socialMediaLinks.delete')
        @if(isset($socialMediaLink))
            <a href="{{ route('socialMediaLinks.destroy', $socialMediaLink->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Title Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('socialMediaLink.fields.title_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $socialMediaLink->title_en }}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
        $input_name = 'title_' . $system_language;
        $input_value = (isset($socialMediaLink))? $socialMediaLink->$input_name : ''
    ?>
    <div class="col-sm-3 form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("socialMediaLink.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $input_value }}</div>
    </div>
@endforeach

<!-- Icon Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.icon_help') }}"></i> &nbsp;{!! Form::label('icon', trans('socialMediaLink.fields.icon')) !!} &nbsp; <a href="https://fontawesome.com/icons" target="_blank"><i class="fa fa-external-link" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.more_icons') }}"></i></a>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><i class="fa {{ $socialMediaLink->icon }}"></i></div>
</div>

<!-- Background Color Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.background_color_help') }}"></i> &nbsp;{!! Form::label('background_color', trans('socialMediaLink.fields.background_color')) !!} &nbsp; <a href="https://htmlcolorcodes.com" target="_blank"><i class="fa fa-external-link" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.more_icons') }}"></i></a>
    <div class="field_show" style="background: {{$socialMediaLink->background_color}}"><div class="col-sm-1">&nbsp;</div>&nbsp;</div>
</div>

<!-- Class Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.class_help') }}"></i> &nbsp;{!! Form::label('class', trans('socialMediaLink.fields.class')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $socialMediaLink->class }}</div>
</div>

<!-- Active Field -->
<div class="col-sm-3 form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("socialMediaLink.fields.active")) !!}
    <h4>
        @if($socialMediaLink->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Link Field -->
<div class="col-sm-6 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.class_help') }}"></i> &nbsp;{!! Form::label('link', trans('socialMediaLink.fields.class')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><a href="{{url($socialMediaLink->link)}}"><i class="fa fa-external-link"></i> {{ $socialMediaLink->link }}</a></div>
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
<div class="col-sm-3 form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('socialMediaLink.fields.description_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $socialMediaLink->description_en ?></div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $socialMediaLink->$input_name;
    ?>
    <div class="col-sm-3 form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('socialMediaLink.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("socialMediaLink.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>
    </div>
@endforeach


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('socialMediaLinks.list')
        <a href="{{ route('socialMediaLinks.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('socialMediaLinks.edit')
        <a href="{{ route('socialMediaLinks.edit', $socialMediaLink->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('socialMediaLinks.delete')
        <a href="{{ route('socialMediaLinks.destroy', $socialMediaLink->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>


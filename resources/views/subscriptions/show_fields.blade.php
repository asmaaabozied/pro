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
            @if($subscription->en)
                <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @foreach($system_languages as $system_language)
            <label>
                {{ strtoupper($system_language) }}
                @if($subscription->$system_language)
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('subscription.fields.title_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$subscription->title_en}}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = $subscription->$input_name;
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("subscription.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$input_value}}</div>
    </div>
@endforeach

<!-- Price Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.price_help') }}"></i> &nbsp;{!! Form::label('price', trans('subscription.fields.price')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$subscription->price}}</div>
</div>

<!-- Duration Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.duration_help') }}"></i> &nbsp;{!! Form::label('duration', trans('subscription.fields.duration')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{$subscription->duration}}</div>
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("subscription.fields.active")) !!}
    <h4>
        @if($subscription->active)
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('subscription.fields.description_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $subscription->description_en ?></div>
</div>

@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $subscription->$input_name;
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("subscription.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>
    </div>
@endforeach


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('subscriptions.list')
        <a href="{{ route('subscriptions.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('subscriptions.edit')
        <a href="{{ route('subscriptions.edit', $subscription->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('subscriptions.delete')
        <a href="{{ route('subscriptions.destroy', $subscription->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>

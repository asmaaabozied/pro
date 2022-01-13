<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Notification En Field -->
<div class="form-group col-sm-11">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.notification_en_help') }}"></i> &nbsp;{!! Form::label('notification_en', trans('notification.fields.notification_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $notification->notification_en }}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'notification_' . $system_language;
    $input_value = (isset($notification))? $notification->$input_name : ''
    ?>
    <div class="form-group col-sm-11">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("notification.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $input_value }}</div>
    </div>
@endforeach

@if($notification->type == 'system')
    <!-- Link Field -->
    <div class="form-group col-sm-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.link_help') }}"></i> &nbsp;{!! Form::label('link', trans('notification.fields.link')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><a href="{{route($notification->module.'show', $notification->module_id)}}" target="_blank"><i class="fa fa-link"></i>  {{$notification->module.'/'.$notification->module_id}}</a></div>
    </div>
@endif


<!-- General Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.general_help') }}"></i> &nbsp;{!! Form::label('general', trans("notification.fields.general")) !!}
    <h4>
        @if($notification->general)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("notification.fields.active")) !!}
    <h4>
        @if($notification->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Type Field -->
<div class="form-group col-sm-3" style="display: {{(! @$notification->general)? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.type_help') }}"></i> &nbsp;{!! Form::label('type', trans('notification.fields.type')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $notification->type }}</div>
</div>

<!-- Filter Type Field -->
<div class="form-group col-sm-3" style="display: {{(@$notification->type == 'custom')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.filter_type_help') }}"></i> &nbsp;{!! Form::label('filter_type', trans('notification.fields.filter_type')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $notification->filter_type }}</div>
</div>

<!-- Subscription Field -->
<div class="form-group col-sm-2" style="display: {{(@$notification->filter_type == 'subscriptions')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.subscription_help') }}"></i> &nbsp;{!! Form::label('subscription', trans('notification.fields.subscription')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>
        <?php $title = 'title_'.$language['admin'] ?>
        @foreach($notification->subscriptions as $id => $subscription)
            {{$subscription->subscription->$title}} <br/>
        @endforeach
    </div>
</div>

<!-- Country Field -->
<div class="form-group col-sm-2" style="display: {{(@$notification->filter_type == 'regions')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.country_help') }}"></i> &nbsp;{!! Form::label('country', trans('notification.fields.country')) !!}
    <?php $name = 'name_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{@$notification->country()->$name}}</div>
</div>

<!-- City Field -->
<div class="form-group col-sm-2" style="display: {{(@$notification->filter_type == 'regions')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.cities_help') }}"></i> &nbsp;{!! Form::label('cities', trans('notification.fields.cities')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>
        <?php $name = 'name_'.$language['admin'] ?>
        @foreach($notification->cities as $id => $city)
            {{$city->city->$name}} <br/><div class="col-sm-1">&nbsp;</div>
        @endforeach
    </div>
</div>

<!-- Users Field -->
<div class="form-group col-sm-2" style="display: {{(@$notification->filter_type == 'users')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.users') }}"></i> &nbsp;{!! Form::label('users', trans('notification.fields.users')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>
        @foreach($notification->users as $user)
            {{$user->user->name}} <br/>
        @endforeach
    </div>
</div>

<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('notifications.list')
        <a href="{{ route('notifications.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('notifications.edit')
        <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('notifications.delete')
        <a href="{{ route('notifications.destroy', $notification->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>


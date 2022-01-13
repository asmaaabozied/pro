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
    {!! Form::text('notification_en', null, ['class' => 'form-control', 'readonly' => (isset($notification))? true : false]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'notification_' . $system_language;
    $input_value = (isset($notification))? $notification->$input_name : ''
    ?>
    <div class="form-group col-sm-11">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("notification.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true, 'readonly' => (isset($notification))? true : false]) !!}
    </div>
@endforeach

@if(isset($notification) && $notification->type == 'system')
    <!-- Link Field -->
    <div class="form-group col-sm-5">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.link_help') }}"></i> &nbsp;{!! Form::label('link', trans('notification.fields.link')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><a href="{{route($notification->module.'.show', $notification->module_id)}}" target="_blank"><i class="fa fa-link"></i>  {{$notification->module.'/'.$notification->module_id}}</a></div>
    </div>
@endif

<!-- General Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.general_help') }}"></i> &nbsp;{!! Form::label('general', trans("notification.fields.general")) !!}<br/>
    <label>
        <input type="hidden" name="general" value="0" checked>
        <input {{(isset($notification))? 'readonly' : ''}} type="checkbox" name="general" id="general" @if(@$notification->general) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("notification.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$notification->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Type Field -->
<div class="form-group col-sm-2" id="type_div" style="display: {{(! @$notification->general)? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.type_help') }}"></i> &nbsp;{!! Form::label('type', trans('notification.fields.type')) !!}
    <select {{(isset($notification))? 'readonly' : ''}} class="form-control select2" name="type" id="type">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('notification.types') as $key => $type)
            <option value="{{$key}}" {{($key == @$notification->type)? 'Selected' : ''}}>{{$type}}</option>
        @endforeach
    </select>
</div>

<!-- Filter Type Field -->
<div class="form-group col-sm-2" id="filter_type_div" style="display: {{(@$notification->type == 'custom')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.filter_type_help') }}"></i> &nbsp;{!! Form::label('type', trans('notification.fields.filter_type')) !!}
    <select {{(isset($notification))? 'readonly' : ''}} class="form-control select2" name="filter_type" id="filter_type">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('notification.filter_types') as $key => $filter_type)
            <option value="{{$key}}" {{($key == @$notification->filter_type)? 'Selected' : ''}}>{{$filter_type}}</option>
        @endforeach
    </select>
</div>

<!-- Subscription Field -->
<div class="form-group col-sm-2" id="subscription_div" style="display: {{(@$notification->filter_type == 'subscriptions')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.subscription_help') }}"></i> &nbsp;{!! Form::label('subscription', trans('notification.fields.subscription')) !!}
    <select {{(isset($notification))? 'readonly' : ''}} class="form-control select2 filter" name="subscriptions[]" id="subscriptions" multiple>
        @if(isset($notification))
            <?php $title = 'title_'.$language['admin'] ?>
            @foreach($notification->subscriptions as $id => $subscription)
                <option value="{{$subscription->subscription->id}}">{{$subscription->subscription->$title}}</option>
            @endforeach
        @else
            <option selected disabled>{{trans('common.select')}}</option>
            @foreach($subscriptions as $id => $subscription)
                <option value="{{$id}}">{{$subscription}}</option>
            @endforeach
        @endif
    </select>
</div>

<!-- Country Field -->
<div class="form-group col-sm-2" id="country_div" style="display: {{(@$notification->filter_type == 'regions')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.country_help') }}"></i> &nbsp;{!! Form::label('country', trans('notification.fields.country')) !!}
    <select {{(isset($notification))? 'readonly' : ''}} class="form-control select2 filter" name="country" id="country">
        @if(isset($notification))
            <?php $name = 'name_'.$language['admin'] ?>
            <option selected value="{{@$notification->country()->id}}">{{@$notification->country()->$name}}</option>
        @else
            <option selected disabled>{{trans('common.select')}}</option>
            @foreach($countries as $id => $country)
                <option value="{{$id}}" {{($id == @$notification->country->id)? 'Selected' : ''}}>{{$country}}</option>
            @endforeach
        @endif
    </select>
</div>

<!-- City Field -->
<div class="form-group col-sm-2" id="city_div" style="display: {{(@$notification->filter_type == 'regions')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.cities_help') }}"></i> &nbsp;{!! Form::label('cities', trans('notification.fields.cities')) !!}
    <select {{(isset($notification))? 'readonly' : ''}} class="form-control select2 filter" name="cities[]" id="cities" multiple>
        @if(isset($notification))
            <?php $name = 'name_'.$language['admin'] ?>
            @foreach($notification->cities as $id => $city)
                <option value="{{$city->city->id}}">{{$city->city->$name}}</option>
            @endforeach
        @else
            <option selected disabled>{{trans('common.select')}}</option>
        @endif
    </select>
</div>

<!-- User Id Field -->
<div id="users_div" class="form-group col-sm-2" style="display: {{(@$notification->filter_type == 'users')? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('notification.fields.users_help') }}"></i> &nbsp;{!! Form::label('users', trans('notification.fields.users')) !!}
    <select {{(isset($notification))? 'readonly' : ''}} class="form-control select2 filter" name="users[]" id="users" multiple>
        @if(isset($notification))
            @foreach($notification->users as $user)
                <option value="{{$user->user->id}}">{{$user->user->name}}</option>
            @endforeach
        @else
            <option selected disabled>{{trans('common.select')}}</option>
            @foreach($users as $id => $user)
                <option value="{{$id}}" {{($id == @$notification->user_id)? 'Selected' : ''}}>{{$user}}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="col-sm-12">
    <br/>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('notifications.list')
        <a href="{{ route('notifications.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['notifications.edit', 'notifications.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('notifications.delete')
        @if(isset($notification))
            <a href="{{ route('notifications.destroy', $notification->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>


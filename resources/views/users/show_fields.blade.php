<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Account Type Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.account_type_help') }}"></i> &nbsp;{!! Form::label('account_type', trans('user.fields.account_type')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> {{ $user->accountType->type }}</div>
</div>

<!-- Name Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.name_help') }}"></i> &nbsp;{!! Form::label('name', trans('user.fields.name')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> {{ $user->name }}</div>
</div>

<!-- Mobile Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.mobile_help') }}"></i> &nbsp;{!! Form::label('mobile', trans('user.fields.mobile')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> <a href="call:{{ $user->mobile }}"><i class="fa fa-mobile-phone"></i> {{ $user->mobile }}</a></div>
</div>

<!-- Email Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.email_help') }}"></i> &nbsp;{!! Form::label('email', trans('user.fields.email')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> <a href="mailTo:{{ $user->email }}"><i class="fa fa-envelope"></i> {{ $user->email }}</a></div>
</div>

<?php $name = 'name_'.$language['admin'] ?>
<!-- Country Id Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.country_id_help') }}"></i> &nbsp;{!! Form::label('country_id', trans('user.fields.country_id')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> {{ $user->country->$name }}</div>
</div>

<!-- City Id Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.address_help') }}"></i> &nbsp;{!! Form::label('address', trans('user.fields.address')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> {{ $user->city->$name }}</div>
</div>

<!-- Address Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.address_help') }}"></i> &nbsp;{!! Form::label('address', trans('user.fields.address')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> {{ $user->address }}</div>
</div>

<!-- Status Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.status_help') }}"></i> &nbsp;{!! Form::label('status', trans('user.fields.status')) !!}<br/>
    <div class="field_show text-center" style="background: {{array_search($user->status, trans('user.account_status'))}}"><div class="col-sm-1">&nbsp;</div> <span style="color: white">{{ $user->status }}</span></div>
</div>

<!-- Store Account Type Field -->
<div class="col-sm-3 form-group" style="display: {{($user->account_type == 3)? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.store_account_type_help') }}"></i> &nbsp;{!! Form::label('store_account_type', trans('user.fields.store_account_type')) !!}<br/>
    <div class="field_show text-center" style="background: {{array_search($user->store_account_type, trans('user.store_account_type'))}}"><div class="col-sm-1">&nbsp;</div> <span style="color: white">{{ $user->store_account_type }}</span></div>
</div>

<!-- Image Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('user.fields.image')) !!}
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
                <img class="ImagePreview" src="{{ asset($user->image) }}" style="width: 100% !important; height: 100% !important;"/>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Verified Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.mobile_verified_help') }}"></i> &nbsp;{!! Form::label('mobile_verified', trans('user.fields.mobile_verified')) !!}<br/>
    <h4>
        @if($user->mobile_verified)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Email Verified Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.email_verified_help') }}"></i> &nbsp;{!! Form::label('email_verified', trans('user.fields.email_verified')) !!}<br/>
    <h4>
        @if($user->email_verified)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Activated Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.activated_help') }}"></i> &nbsp;{!! Form::label('activated', trans('user.fields.activated')) !!}<br/>
    <h4>
        @if($user->activated)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('users.list')
        <a href="{{ route('users.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('users.edit')
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('users.delete')
        <a href="{{ route('users.destroy', $user->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>

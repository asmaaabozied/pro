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
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.account_type_help') }}"></i> &nbsp;{!! Form::label('account_type', trans('user.fields.account_type')) !!}
    <select class="form-control select2" name="account_type" id="account_type">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($account_types as $id => $account_type)
            <option value="{{$id}}" {{($id == @$user->account_type)? 'Selected' : ''}}>{{$account_type}}</option>
        @endforeach
    </select>
</div>

<!-- Name Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.name_help') }}"></i> &nbsp;{!! Form::label('name', trans('user.fields.name')) !!}
    {!! Form::text('name', @$user->name, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.mobile_help') }}"></i> &nbsp;{!! Form::label('mobile', trans('user.fields.mobile')) !!}
    {!! Form::text('mobile',  @$user->mobile, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.email_help') }}"></i> &nbsp;{!! Form::label('email', trans('user.fields.email')) !!}
    {!! Form::email('email',  @$user->email, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.password_help') }}"></i> &nbsp;{!! Form::label('password', trans('user.fields.password')) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Password Confirmation Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.password_confirmation_help') }}"></i> &nbsp;{!! Form::label('password_confirmation', trans('user.fields.password_confirmation')) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('user.fields.image')) !!}
    <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image" id="image" @if(! isset($user)) required @endif>
</div>
<div class="form-group col-sm-3 ImagePreview" style="display: none">

    <label class="control-label">
        {{ trans('common.preview_button') }}
    </label>
    <br/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
</div>
@if(@$user !=  null)
    <div class="form-group col-sm-3" style="display: {{(isset($user))? 'block' : 'none'}}">

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
                <img class="ImagePreview" src="{{ asset(@$user->image) }}" style="width: 100% !important; height: 100% !important;"/>
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

<!-- Country Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.country_id_help') }}"></i> &nbsp;{!! Form::label('country_id', trans('user.fields.country_id')) !!}
    <select class="form-control select2" name="country_id" id="country_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($countries as $id => $country)
            <option value="{{$id}}" {{($id == @$user->country_id)? 'Selected' : ''}}>{{$country}}</option>
        @endforeach
    </select>
</div>

<!-- City Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.city_id_help') }}"></i> &nbsp;{!! Form::label('city_id', trans('user.fields.city_id')) !!}
    <select class="form-control select2" name="city_id" id="city_id">
        @if(isset($user))
            <?php $name = 'name_'.$language['admin'] ?>
            <option selected value="{{$user->city_id}}">{{$user->city->$name}}</option>
        @else
            <option selected disabled>{{trans('common.select')}}</option>
        @endif
    </select>
</div>

<!-- Address Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.address_help') }}"></i> &nbsp;{!! Form::label('address', trans('user.fields.address')) !!}
    {!! Form::text('address',  @$user->address, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.status_help') }}"></i> &nbsp;{!! Form::label('status', trans('user.fields.status')) !!}<br/>
    <select class="form-control select2" name="status" id="status">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('user.account_status') as $color => $status)
            <option value="{{$status}}" {{($status == @$user->status)? 'Selected' : ''}}>{{$status}}</option>
        @endforeach
    </select>
</div>

<!-- Store Account Type Field -->
<div class="form-group col-sm-3" style="display: {{(@$user->account_type == 3)? 'block' : 'none'}}">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.store_account_type_help') }}"></i> &nbsp;{!! Form::label('store_account_type', trans('user.fields.store_account_type')) !!}<br/>
    <select class="form-control select2" name="store_account_type" id="store_account_type">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('user.store_account_type') as $color => $store_account_type)
            <option value="{{$store_account_type}}" {{($store_account_type == @$user->store_account_type)? 'Selected' : ''}}>{{$store_account_type}}</option>
        @endforeach
    </select>
</div>

<!-- Mobile Verified Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.mobile_verified_help') }}"></i> &nbsp;{!! Form::label('mobile_verified', trans('user.fields.mobile_verified')) !!}<br/>
    <label>
        <input type="hidden" name="mobile_verified" id="mobile_verified" value="0" checked>
        <input type="checkbox" name="mobile_verified" id="mobile_verified" @if(@$user->mobile_verified) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Email Verified Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.email_verified_help') }}"></i> &nbsp;{!! Form::label('email_verified', trans('user.fields.email_verified')) !!}<br/>
    <label>
        <input type="hidden" name="email_verified" id="email_verified" value="0" checked>
        <input type="checkbox" name="email_verified" id="email_verified" @if(@$user->email_verified) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Activated Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields.activated_help') }}"></i> &nbsp;{!! Form::label('activated', trans('user.fields.activated')) !!}<br/>
    <label>
        <input type="hidden" name="activated" id="activated" value="0" checked>
        <input type="checkbox" name="activated" id="activated" @if(@$user->activated) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('user.fields.roles_and_permissions') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Role Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields..role_help') }}"></i> &nbsp;{!! Form::label('role', trans("user.fields.role")) !!}<br>
    {{-- <select class="form-control select2" name="roles[]" id="roles" multiple>
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($roles as $role)
            <option value="{{$role}}">{{$role}}</option>
        @endforeach
    </select> --}}
    <input type="checkbox" id="roles_select_all" name="roles_select_all" value="" onClick="all_roles(this)">
    <label for="vehicle1"> Select All Roles</label><br>
    @foreach($roles as $role)
        <input type="checkbox" id="{{$role}}" name="roles[]" value="{{$role}}">
        <label for="vehicle1"> {{$role}}</label><br>
    @endforeach
</div>

<!-- Permission Field -->
<div class="form-group col-sm-9">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('user.fields..role_help') }}"></i> &nbsp;{!! Form::label('permission', trans("user.fields.permission")) !!}<br>
    {{-- <select class="form-control select2" name="permissions[]" id="permissions" multiple>
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($permissions as $permission)
            <option value="{{$permission}}">{{$permission}}</option>
        @endforeach
    </select> --}}
    <input type="checkbox" id="permissions_select_all" name="permissions_select_all" value="" onClick="all_permissions(this)">
    <label for="vehicle1"> Select All Permissions</label><br>
    <div class="row">
    @foreach($permissions as $permission)
        <div class="col-sm-3">
            <input type="checkbox" id="{{$permission}}" name="permissions[]" value="{{$permission}}">
            <label for="vehicle1"> {{$permission}}</label>
        </div>
    @endforeach
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
{{--    @can('users.list')--}}
        <a href="{{ route('users.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
{{--    @endcan--}}
    <div class="col-sm-1">&nbsp;</div>
{{--    @canany(['users.edit', 'users.create'])--}}
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
{{--    @endcanany--}}
    <div class="col-sm-1">&nbsp;</div>
<!-- {{--    @can('users.delete')--}}
        @if(isset($user) && ($user->id != 1))
            <a href="{{ route('users.destroy', $user->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
{{--    @endcan--}} -->
</div>

@push('scripts')
    <script language="JavaScript">
        function all_roles(source) {
            
            checkboxes = document.getElementsByName('roles[]');
            checkboxes[0].checked = 'checked';
            console.log(checkboxes[0].checked);
            for(var i = 0; i < checkboxes.length; i++)
                // console.log(checkbox);
                checkboxes[i].checked = source.checked;
        }
        function all_permissions(source) {
            
            checkboxes = document.getElementsByName('permissions[]');
            checkboxes[0].checked = 'checked';
            console.log(checkboxes[0].checked);
            for(var i = 0; i < checkboxes.length; i++)
                // console.log(checkbox);
                checkboxes[i].checked = source.checked;
        }
    </script>
@endpush

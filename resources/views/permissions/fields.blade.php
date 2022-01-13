<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('role.fields.permission.name_help') }}"></i> {!! Form::label('name', trans('role.fields.permission.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- role Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('role.fields.permission.role_help') }}"></i> &nbsp;{!! Form::label('parent', trans("role.fields.permission.role")) !!}
    <select class="form-control select2" name="roles[]" id="roles" multiple>
        <option selected disabled>{{trans('common.select')}}</option>
        <?php $permissionRoles = isset($permission)? $permission->roles->pluck('name')->toArray() : []; ?>
        @foreach($roles as $role)
            @if(! in_array($role->name, $permissionRoles))
                <option value="{{$role->name}}">{{$role->name}}</option>
            @endif
        @endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('permissions.list')
        <a href="{{ route('permissions.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['permissions.edit', 'permissions.create'])
        <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('permissions.delete')
        @if(isset($permission))
            <a href="{{ route('permissions.destroy', $permission->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

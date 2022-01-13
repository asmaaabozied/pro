<div class="box box-default collapsed-box">
    <div class="box-header with-border">
        <hr style="border-color: #3c8dbcab"/>
        <div class="col-sm-12">
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('role.fields.permission.assigned_roles') }}</b></h4>
            </div>
            <div class="col-sm-12">
                <br/>
            </div>
        </div>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row text-center">
            <div class="col-sm-9 text-center">
                <div class="table table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td><h5><b>{{trans('role.fields.role.name')}}</b></h5></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permission->roles as $role)
                                <tr>
                                    <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $role->name }}</div></td>
                                    <td>
                                        @can('roles.show')
                                            <a href="{{route('roles.show', $role->id)}}" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        @endcan
                                        @can('roles.edit')
                                            <a href="{{route('roles.edit', $role->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('permission.edit')
                                                <a href="{{route('roles.revoke-permission', ['role_id' => $role->id, 'permission_id' => $permission->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
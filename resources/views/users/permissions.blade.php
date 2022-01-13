<div class="box box-default collapsed-box">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <hr style="border-color: #3c8dbcab"/>
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('user.fields.assigned_permissions') }}</b></h4>
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
                                <td><h5><b>{{trans('user.fields.permission')}}</b></h5></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(array_key_exists(0, $user->getDirectPermissions()->toArray()))
                                @foreach($user->getDirectPermissions() as $permission)
                                    <tr>
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $permission->name }}</div></td>
                                        <td>
                                            @can('permissions.show')
                                                <a href="{{route('permissions.show', $permission->id)}}" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                                            @endcan
                                            @can('permissions.edit')
                                                <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('users.edit')
                                                <a href="{{route('users.revoke-permission', ['user_id' => $user->id, 'permission_id' => $permission->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="2"><b>{{trans('common.no_data')}}</b></td></tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
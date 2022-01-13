<div class="box box-default collapsed-box">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <hr style="border-color: #3c8dbcab"/>
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('user.fields.gifts') }}</b></h4>
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
                                <td><h5><b>{{trans('common.title')}}</b></h5></td>
                                <td><h5><b>{{trans('common.description')}}</b></h5</td>
                                <td><h5><b>{{trans('common.action')}}</b></h5</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(array_key_exists(0, $user->gifts->toArray()))
                                @foreach($user->gifts as $gift)
                                    <tr>
                                        <td><div class="field_show text-center"><div class="col-sm-2">&nbsp;</div>{{ $gift->title }}</div></td>
                                        <td><div class="field_show text-center"><div class="col-sm-4">&nbsp;</div>{{ $gift->description }}</div></td>

                                        <td>
                                            @can('users.edit')
                                                    <a href="{{route('users.revoke-gift', ['user_id' => $user->id, 'gift_id' => $gift->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>
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
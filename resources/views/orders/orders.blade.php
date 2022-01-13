<div class="box box-default">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('home.fields.today_orders') }}</b></h4>
            </div>
            <div class="col-sm-12">
                <br/>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row text-center">
            <div class="col-sm-12 text-center">
                <div class="table table-responsive">
                    <div class="alert alert-success" style="display: none;" id="deleteSuccess"><div>{{ trans('common.messages.deleted') }}</div> </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td><h5><b>{{trans('order.fields.user_id')}}</b></h5></td>
                                <td><h5><b>{{trans('order.fields.id')}}</b></h5></td>
                                <td><h5><b>{{trans('order.fields.total')}}</b></h5></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($orders))
                                <?php $total = 0; ?>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><div class="col-sm-1">&nbsp;</div><a href="{{route('users.show', ['user' => $order->user_id])}}" target="_blank"><i class="fa fa-user"></i> {{$order->user->name}}</a></td>
                                        <td><div class="col-sm-1">&nbsp;</div>{{$order->id}}</td>
                                        <td><div class="col-sm-1">&nbsp;</div>{{$order->total}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="3"><b>{{trans('common.no_data')}}</b></td></tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
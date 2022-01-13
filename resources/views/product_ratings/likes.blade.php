<div class="box box-default collapsed-box">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <hr style="border-color: #3c8dbcab"/>
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('productRating.fields.likes.header') }}</b></h4>
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
                                <td><h5><b>{{trans('productRating.fields.likes.user')}}</b></h5></td>
                                <td><h5><b>{{trans('productRating.fields.likes.like')}}</b></h5></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(array_key_exists(0, $productRating->likeList->toArray()))
                                @foreach($productRating->likeList as $item)
                                    <tr>
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><a href="{{route('users.show', $item->user->id)}}"><img src="{{asset($item->user->image)}}" class="img-circle" height="50px" width="50px" onerror="this.onerror=null; this.src='{{asset('images/default-user.png')}}'">&nbsp;{{$item->user->name}}</a></div></td>
                                        <td>
                                            <div class="checkbox">
                                                @if($item->like)
                                                    <i style="color: green;" class="fa fa-lg fa-thumbs-up"></i>
                                                @else
                                                    <i style="color: red;" class="fa fa-lg fa-thumbs-down"></i>
                                                @endif
                                            </div>
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
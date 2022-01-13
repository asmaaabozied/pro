<div class="box box-default collapsed-box skin-blue">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <hr style="border-color: #3c8dbcab"/>
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('coupons.fields.images_header') }}</b></h4>
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
                    <div class="alert alert-success" style="display: none;" id="deleteSuccess">
                        <div>{{ trans('common.messages.deleted') }}</div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td><h5><b>{{trans('coupons.fields.image')}}</b></h5></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(array_key_exists(0, $coupon->images->toArray()))
                                @foreach($coupon->images as $image)
                                    <tr class="image{{$image->id}}">
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><img src="{{asset($image->image)}}" width="100px" height="100px"></div></td>
                                        <td>
                                            @can('coupons.edit')
                                                <button type="button"
                                                        class="btn btn-sm btn-danger deleteImage"
                                                        value="{{$image->id}}"><i class="fa fa-remove"></i>
                                                </button>
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
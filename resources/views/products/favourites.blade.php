<div class="box box-default collapsed-box">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <hr style="border-color: #3c8dbcab"/>
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('product.fields.favourites.header') }}</b></h4>
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
                                <td><h5><b>{{trans('product.fields.favourites.user')}}</b></h5></td>
                                <td><h5><b>{{trans('product.fields.favourites.ip')}}</b></h5></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(array_key_exists(0, $product->favourites->toArray()))
                                @foreach($product->favourites as $favourite)
                                    <tr>
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><a href="">{{optional($favourite->user)->name}}</a></div></td>
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{$favourite->ip}}</div></td>
                                        <td>
                                            @can('productsFavourites.show')
                                                <a href="{{route('productsFavourites.show', $favourite->id)}}"
                                                   class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('productsFavourites.edit')
                                                <a href="{{route('productsFavourites.edit', $favourite->id)}}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-pencil"></i>
                                                </a>
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
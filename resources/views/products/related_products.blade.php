<div class="box box-default collapsed-box skin-blue">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <hr style="border-color: #3c8dbcab"/>
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('product.fields.related_products_tab.header') }}</b></h4>
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
                    <div class="alert alert-success" style="display: none;"
                         id="relatedProductUnlinkSuccess">
                        <div>{{ trans('common.messages.deleted') }}</div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td><h5><b>{{trans('product.fields.related_products_tab.title')}}</b></h5></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(array_key_exists(0, $product->relatedProducts->toArray()))
                                <?php $title = 'title_'.$language['admin'] ?>
                                @foreach($product->relatedProducts as $relatedProduct)
                                    <tr class="relatedProduct{{$relatedProduct->id}}">
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><img src="{{asset(@$relatedProduct->relatedProduct->image)}}" width="50px" height="50px" onerror="this.onerror=null; this.src='{{asset('images/default-image.jpg')}}'">&nbsp; {{$relatedProduct->relatedProduct->$title}}</div></td>
                                        <td>
                                            @can('products.show')
                                                <a href="{{route('products.show', $relatedProduct->id)}}" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                                            @endcan
                                            @can('products.edit')
                                                <a href="{{route('products.edit', $relatedProduct->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @if(Route::currentRouteName() == 'products.edit')
                                                @can('products.edit')
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger unlinkRelatedProduct"
                                                            value="{{$relatedProduct->id}}"><i class="fa fa-unlink"></i>
                                                    </button>
                                                @endcan
                                            @endif
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
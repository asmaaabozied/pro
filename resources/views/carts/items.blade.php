<div class="box box-default collapsed-box">
    <div class="box-header with-border">
        <div class="col-sm-12">
            <hr style="border-color: #3c8dbcab"/>
            <div class="col-sm-12" style="background: #3c8dbcab;">
                <h4 style="color: #222d32"><b>{{ trans('cart.fields.items.header') }}</b></h4>
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
                    <div class="alert alert-success" style="display: none;" id="deleteSuccess"><div>{{ trans('common.messages.deleted') }}</div> </div>
                    <input type="hidden" id="cart_id" value="{{$cart->id}}">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td><h5><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.items.product_id') }}"></i> &nbsp;{{trans('cart.fields.items.product_id')}}</b></h5></td>
                                <td><h5><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.items.quantity') }}"></i> &nbsp;{{trans('cart.fields.items.quantity')}}</b></h5></td>
                                <td><h5><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('cart.fields.items.price') }}"></i> &nbsp;{{trans('cart.fields.items.price')}}</b></h5></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(array_key_exists(0, $cart->items->toArray()))
                                <?php $total = 0; ?>
                                @foreach($cart->items as $item)
                                    <tr class="cartItem{{$item->id}}">
                                        <?php $title = 'title_'.$language['admin'] ?>
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $item->product->$title }}</div></td>
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $item->quantity }}</div></td>
                                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $item->price }}</div></td>
                                        <td>
                                            @can('carts.delete')
                                                <button type="button" value="{{$item->id}}" class="btn btn-sm btn-danger removeCartItem"><i class="fa fa-remove"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                    <?php $total += ($item->price) * ($item->quantity); ?>
                                @endforeach
                                <tr>
                                    <td colspan="2"><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><b>{{ trans('cart.fields.items.total') }}</b></div></td>
                                    <td colspan="2"><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><b><span id="cartItemsTotal">{{ $total }}</span></b></div></td>
                                </tr>
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
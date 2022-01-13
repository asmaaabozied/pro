@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$clients}}</h3>

                            <p>{{trans('home.fields.client')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('users.index', ['account_type' => 'client'])}}" class="small-box-footer">{{trans('common.see_more')}} &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$storeOwners}}</h3>

                            <p>{{trans('home.fields.store_owners')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <a href="{{route('users.index', ['account_type' => 'store_owner'])}}" class="small-box-footer">{{trans('common.see_more')}} &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$products}}</h3>

                            <p>{{trans('home.fields.products')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-archive"></i>
                        </div>
                        <a href="{{route('products.index')}}" class="small-box-footer">{{trans('common.see_more')}} &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{count($currentOrders)}}</h3>

                            <p>{{trans('home.fields.current_orders')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-basket"></i>
                        </div>
                        <a href="{{route('orders.index')}}" class="small-box-footer">{{trans('common.see_more')}} &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{count($previousOrders)}}</h3>

                            <p>{{trans('home.fields.previous_orders')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-basket"></i>
                        </div>
                        <a href="{{route('orders.index')}}" class="small-box-footer">{{trans('common.see_more')}} &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$carts}}</h3>

                            <p>{{trans('home.fields.carts')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="{{route('carts.index')}}" class="small-box-footer">{{trans('common.see_more')}} &nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

            </div>


            <div class="row">
                <div class="content">
                    @include('orders.orders')
                </div>
            </div>
        </div>

    </section>

</div>
@endsection

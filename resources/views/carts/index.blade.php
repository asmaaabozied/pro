@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2 class="pull-left"><b>{{trans('cart.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('carts.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


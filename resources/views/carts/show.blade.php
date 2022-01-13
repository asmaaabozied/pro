@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('cart.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('carts.show_fields')
                </div>
            </div>
        </div>
        @include('carts.items')
    </div>
    @include('carts.js.script')
@endsection

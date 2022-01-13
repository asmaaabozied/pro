@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('product.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('products.show_fields')
                </div>
            </div>
        </div>
        @include('products.show_images')
        @include('products.related_products')
        @include('products.favourites')
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('product.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       @include('products.images')
       @include('products.related_products')
       @include('products.favourites')
   </div>
   @include('products.js.script')
@endsection
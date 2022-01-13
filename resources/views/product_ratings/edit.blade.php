@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('productRating.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productRating, ['route' => ['productRatings.update', $productRating->id], 'method' => 'patch']) !!}

                        @include('product_ratings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       @include('product_ratings.likes')
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('storeRating.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($storeRating, ['route' => ['storeRatings.update', $storeRating->id], 'method' => 'patch']) !!}

                        @include('store_ratings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('country.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($country, ['route' => ['countries.update', $country->id], 'method' => 'patch']) !!}

                        @include('countries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       @include('countries.cities')
   </div>
@endsection
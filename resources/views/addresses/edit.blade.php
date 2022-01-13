@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('address.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($address, ['route' => ['addresses.update', $address->id], 'method' => 'patch']) !!}

                        @include('addresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
   @include('countries.js.script')
@endsection
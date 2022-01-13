@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('order.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($order, ['route' => ['orders.update', $order->id], 'method' => 'patch']) !!}

                        @include('orders.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       @include('orders.items')
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('subscription.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($subscription, ['route' => ['subscriptions.update', $subscription->id], 'method' => 'patch']) !!}

                        @include('subscriptions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
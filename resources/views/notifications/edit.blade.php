@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('notification.menu')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($notification, ['route' => ['notifications.update', $notification->id], 'method' => 'patch']) !!}

                        @include('notifications.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       @include('notifications.notified_users')
   </div>
    @include('notifications.js.script')
@endsection
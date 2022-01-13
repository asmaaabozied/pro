@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{\Illuminate\Support\Facades\Config::get('AccountType')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       @include('users.roles')
       @include('users.permissions')
   </div>
   @include('users.js.script')
@endsection
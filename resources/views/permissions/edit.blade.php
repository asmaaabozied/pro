@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('role.menu.permission')}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'patch']) !!}

                        @include('permissions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
       @include('permissions.roles')
   </div>
@endsection
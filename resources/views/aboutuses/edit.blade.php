@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans("aboutus.$slug")}}</b></h2>
    </section>
   <div class="content">
       <div class="clearfix"></div>
           @include('flash::message')
           @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($aboutUs, ['route' => ['aboutuses.update', $id], 'method' => 'patch']) !!}

                        @include('aboutuses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
   @include('aboutuses.js.script')
@endsection
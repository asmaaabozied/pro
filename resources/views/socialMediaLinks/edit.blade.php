@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('socialMediaLink.menu')}}</b></h2>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($socialMediaLink, ['route' => ['socialMediaLinks.update', $socialMediaLink->id], 'method' => 'patch']) !!}

                        @include('socialMediaLinks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('socialMediaLink.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="clearfix"></div>
            @include('flash::message')
            @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'socialMediaLinks.store']) !!}

                        @include('socialMediaLinks.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

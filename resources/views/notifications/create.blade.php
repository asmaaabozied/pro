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
                    {!! Form::open(['route' => 'notifications.store']) !!}

                        @include('notifications.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @include('notifications.js.script')
@endsection

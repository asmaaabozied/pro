@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            <h2><b>{{trans('storeType.menu')}}</b></h2>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
            @include('flash::message')
            @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'storeTypes.store']) !!}

                        @include('store_types.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

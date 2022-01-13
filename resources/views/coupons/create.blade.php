@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('coupons.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'coupons.store', 'files' => true]) !!}

                    @include('coupons.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @include('coupons.js.script')
@endsection
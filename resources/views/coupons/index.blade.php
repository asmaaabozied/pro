@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2 class="pull-left"><b>{{trans('coupons.menu')}}</b></h2>
        <h1 class="pull-right">
            <a class="btn btn-success pull-right" href="{{ route('coupons.create') }}"><i class="fa fa-plus"></i> {{trans('common.new')}}</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('coupons.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


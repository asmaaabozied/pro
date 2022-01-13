@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2 class="pull-left"><b>{{trans('orderActionsReason.menu')}}</b></h2>
        <h1 class="pull-right">
            <a class="btn btn-success pull-right" href="{{ route('orderActionsReasons.create') }}"><i class="fa fa-plus"></i> {{trans('common.new')}}</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
            @include('flash::message')
            @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('order_actions_reasons.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


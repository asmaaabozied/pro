@extends('layouts.app')

@section('content')
    @include('store_subscriptions.js.script')
    <section class="content-header">
        <h2><b>{{trans('storeSubscription.menu')}}</b></h2>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'storeSubscriptions.store']) !!}

                        @include('store_subscriptions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

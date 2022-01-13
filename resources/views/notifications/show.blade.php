@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('notification.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('notifications.show_fields')
                </div>
            </div>
        </div>
        @include('notifications.notified_users')
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('role.menu.role')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('roles.show_fields')
                </div>
            </div>
        </div>
        @include('roles.permissions')
    </div>
@endsection

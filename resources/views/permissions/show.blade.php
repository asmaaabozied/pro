@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('role.menu.permission')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('permissions.show_fields')
                    <a href="{{ route('permissions.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
        @include('permissions.roles')
    </div>
@endsection

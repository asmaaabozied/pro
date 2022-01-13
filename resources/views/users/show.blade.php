@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{\Illuminate\Support\Facades\Config::get('AccountType')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('users.show_fields')
                </div>
            </div>
        </div>
        @include('users.roles')
        @include('users.permissions')
        @include('users.gifts')
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2>{{trans('language.menu')}}</h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('languages.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection

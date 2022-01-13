@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('category.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('categories.show_fields')
                </div>
            </div>
        </div>
        @include('categories.sub_categories')
        @include('categories.brands')
    </div>
@endsection

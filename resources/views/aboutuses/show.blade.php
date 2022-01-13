@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans("aboutus.$slug")}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('aboutuses.show_fields')
                </div>
            </div>
        </div>
    </div>
    @include('aboutuses.js.script')
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h2><b>{{trans('supportTicket.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('support_tickets.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection

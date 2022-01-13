@extends('layouts.app')

@section('content')
<style>
.card-widget {
    border: 0;
    position: relative;
}
.card {
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    margin-bottom: 1rem;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}
.widget-user .widget-user-header {
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    height: 135px;
    padding: 1rem;
    text-align: center;
}
.widget-user .widget-user-image>img {
    border: 3px solid #fff;
    height: auto;
    width: 90px;
}
.widget-user .widget-user-image {
    position: absolute;
    top: 85px;
    left: 50%;
    margin-left: -45px;
}
.description-block>.description-text {
    text-transform: uppercase;
}
.elevation-2 {
    box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23)!important;
}
.img-circle {
    border-radius: 50%;
}
img {
    vertical-align: middle;
    border-style: none;
}
.bg-info, .bg-info>a {
    color: #fff!important;
}
.bg-info {
    background-color: #17a2b8!important;
}
.card-footer {
    padding: .75rem 1.25rem;
    background-color: rgba(0,0,0,.03);
    border-top: 0 solid rgba(0,0,0,.125);
}
</style>
    <section class="content-header">
        <h2><b>{{trans('subscription.menu')}}</b></h2>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @foreach( $subscriptions as $subscription)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username">{{$subscription->title}}</h3>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="{{asset('light-icon.png')}}" alt="Avatar">
                            
                            </div>
                            <div class="card-footer">
                                <div class="row text-center" style="padding: 15px;">
                                    <h5 class="col-sm-12"style="min-height: 50px;display: inline-grid;align-items: center;">{!!$subscription->description!!}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            @if(!empty($subscription->price) && $subscription->price>0 )
                                            <h5 class="description-header">{{$subscription->price}}</h5>
                                            <span class="description-text">Price</span>
                                            @else
                                                <h5 class="description-header">Free</h5>
                                            @endif
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                        <h5 class="description-header">@if(!empty($subscription->duration) && $subscription->duration!=0){{$subscription->duration}} Months @else Unlimited @endif </h5>
                                        <span class="description-text">Duration</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                        <h5 class="description-header">{{$subscription->max_product}}</h5>
                                        <span class="description-text">PRODUCTS</span>
                                        </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                </div>

                                <div class="row text-center" style="padding: 15px;">
                                    @if(Auth::user()->account_type==1 ||Auth::user()->account_type==2 )

                                    @elseif(count($stores_subscription_ids_Arr)>0 && in_array($subscription->id , $stores_subscription_ids_Arr))
                                        <div> expire_date : {{ $stores_subscription[$subscription->id]->expire_date->format('Y-m-d') }}</div>
                                    @else
                                        <a href="{{route('storeSubscriptions.create', ['sub_id' => $subscription->id] )}}" 
                                            class="small-box-footer">{{trans('common.subscribe_now')}} &nbsp;&nbsp;
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                                <!-- /.row -->
                            </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>

                    @endforeach
                
                </div>
            </div>
        </div>
    </div>
@endsection

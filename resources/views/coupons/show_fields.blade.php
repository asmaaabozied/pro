<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
<?php $name = 'name_'.$language['admin'] ?>
<?php $title = 'title_'.$language['admin'] ?>

<div class="">
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('coupons.fields.title_en')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon->title_en}}</div>

    </div>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_ar_help') }}"></i> &nbsp;{!! Form::label('title_ar', trans('coupons.fields.title_ar')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon->title_ar}}</div>
    </div>

    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.city_id_help') }}"></i> &nbsp;{!! Form::label('city_id', trans("coupons.fields.city_id")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->city->$name}}</div>
    </div>

    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("coupons.fields.category_id")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->category->$title}}</div>
    </div>

    <!-- Code Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.code_help') }}"></i> &nbsp;{!! Form::label('code', trans('coupons.fields.code')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->code}}</div>

    </div>

    <!-- Count Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.count_help') }}"></i> &nbsp;{!! Form::label('count', trans('coupons.fields.count')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->count}}</div>

    </div>

    <!-- Usage Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.usage_help') }}"></i> &nbsp;{!! Form::label('usage', trans('coupons.fields.usage')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->usage}}</div>

    </div>
    
    <!-- Rate Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('coupons.fields.rate')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->discount_rate}}</div>

    </div>

    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.start_at_help') }}"></i> &nbsp;{!! Form::label('start_at', trans('coupons.fields.start_at')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->start_at}}</div>


    </div>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.valid_to') }}"></i> &nbsp;{!! Form::label('valid_to', trans('coupons.fields.valid_to')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ @$coupon->valid_to}}</div>

    </div>


    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.store_help') }}"></i> &nbsp;{!! Form::label('stores', trans("coupons.fields.stores")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon->store->$name}}</div>
    </div>

    <!-- Image Field -->
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('coupons.fields.image')) !!}
        <div class="form-group">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
        </div>
    </div>
    <div id="current_image" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>{{ trans('common.current_image') }}</b></h4>
                </div>
                <div class="modal-body text-center" id="data" style="display: block;">
                    <img class="ImagePreview" src="{{ asset($coupon->image) }}" style="width: 100% !important; height: 100% !important;"/>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("coupons.fields.active")) !!}
        <h4>
            @if($coupon->active)
                <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </h4>
    </div>

    <!-- featured Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.featured_help') }}"></i> &nbsp;{!! Form::label('featured', trans("coupons.fields.featured")) !!}
        <h4>
            @if($coupon->featured)
                <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </h4>
    </div>

    <!-- inslider Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.inslider_help') }}"></i> &nbsp;{!! Form::label('inslider', trans("coupons.fields.inslider")) !!}
        <h4>
            @if($coupon->inslider)
                <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </h4>
    </div>


</div>

<!-- ////////////////////////coupons Details ////////////////////////////////////// -->
<!-- <div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;display: inline-flex;">
        <h4 style="color: #222d32"><b>{{ trans('coupons.fields.coupon_details') }}</b></h4>
        <div class="btn btn-success" style="border-radius: 10px;border: none;" id="addCouponDetails"><i class="fa fa-plus" style="color: #fff"></i></div>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
<div  id="coupon_details_from">
    @if(!empty($coupon_details) && count($coupon_details) >0)
        @foreach($coupon_details as $index => $coupon_detail)
        <div class="col-sm-12 detailRow" id="{{$index}}_rowIndex">
            <input hidden name="id" value="{{$coupon_detail->id}}" />
            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('coupons.fields.details.title_en')) !!}
                <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon_detail->title_en}}</div>
            </div>
            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_ar_help') }}"></i> &nbsp;{!! Form::label('title_ar', trans('coupons.fields.details.title_ar')) !!}
                <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon_detail->title_ar}}</div>

            </div>

            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.old_price_help') }}"></i> &nbsp;{!! Form::label('old_price', trans('coupons.fields.old_price')) !!}
                <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon_detail->old_price}}</div>

            </div>

            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"  title=" {{ trans('coupons.fields.new_price_help') }}"></i> &nbsp;{!! Form::label('new_price', trans('coupons.fields.new_price')) !!}
                <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon_detail->new_price}}</div>

            </div>

            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.start_at_help') }}"></i> &nbsp;{!! Form::label('start_at', trans('coupons.fields.start_at')) !!}
                <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon_detail->start_at}}</div>

            </div>
            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.end_at_help') }}"></i> &nbsp;{!! Form::label('end_at', trans('coupons.fields.end_at')) !!}
                <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $coupon_detail->end_at}}</div>

            </div>
        </div>
        @endforeach
    @endif

</div> -->
<!-- ///////////////////////////////////////////////////////////////////////////////// -->


<div class="col-sm-12">
    <br/>
</div>

<div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.editors') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Description En Field -->
<div class="form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('coupons.fields.description_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $coupon->description_en ?></div>
</div>

@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $coupon->$input_name;
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("coupons.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>
    </div>
@endforeach


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('coupons.fields.list')
        <a href="{{ route('coupons.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('coupons.fields.edit')
        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('coupons.fields.delete')
        <a href="{{ route('coupons.destroy', $coupon->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>
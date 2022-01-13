<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
<div class="">
    <input hidden name='id' value="@if(isset($coupon)) {{$coupon->id}} @endif" />

    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('coupons.fields.title_en')) !!}
        {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3]) !!}
    </div>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_ar_help') }}"></i> &nbsp;{!! Form::label('title_ar', trans('coupons.fields.title_ar')) !!}
        {!! Form::text('title_ar', null, ['class' => 'form-control','minlength' => 3]) !!}
    </div>

    <!-- Code Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.code_help') }}"></i> &nbsp;{!! Form::label('code', trans('coupons.fields.code')) !!}
        {!! Form::text('code', null, ['id'=>'code' ,'class' => 'form-control', 'min' => 3, 'readonly' => (isset($coupon) && ($coupon->code != null))? true : false, 'required' => true]) !!}
    </div>

    <!-- Count Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.count_help') }}"></i> &nbsp;{!! Form::label('count', trans('coupons.fields.count')) !!}
        {!! Form::number('count', null, ['class' => 'form-control', 'min' => 0, 'step' => 1, 'required' => true]) !!}
    </div>

    <!-- Usage Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.usage_help') }}"></i> &nbsp;{!! Form::label('usage', trans('coupons.fields.usage')) !!}
        {!! Form::number('usage', null, ['class' => 'form-control', 'min' => 0, 'step' => 1, 'readonly' => true]) !!}
    </div>
    
    <!-- Rate Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('coupons.fields.rate')) !!}
        {!! Form::number('discount_rate', null, ['class' => 'form-control', 'min' => 0 ,'required' => true]) !!}
    </div>

    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.start_at_help') }}"></i> &nbsp;{!! Form::label('start_at', trans('coupons.fields.start_at')) !!}
        {!! Form::date('start_at', null , ['class' => 'form-control', 'required' => true]) !!}

    </div>
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.valid_to') }}"></i> &nbsp;{!! Form::label('valid_to', trans('coupons.fields.valid_to')) !!}
        {!! Form::date('valid_to',null, ['class' => 'form-control', 'required' => true]) !!}

    </div>


    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.city_id_help') }}"></i> &nbsp;{!! Form::label('city_id', trans("coupons.fields.city_id")) !!}
        <select class="form-control select2" name="city_id" id="city_id">
            <option selected disabled>{{trans('common.select')}}</option>
            @foreach(\App\Models\City::pluck('name_en', 'id') as $id => $item)
                <option value="{{$id}}" {{($id == @$coupon->city_id)? 'Selected' : ''}}>{{$item}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.store_help') }}"></i> &nbsp;{!! Form::label('stores', trans("coupons.fields.stores")) !!}
        <select class="form-control select2" name="store_id" id="parent" required>
            <option selected disabled>{{trans('common.select')}}</option>
            @foreach(\App\Models\Store::limited()->pluck('name_en', 'id') as $id => $item)
                <option value="{{$id}}" {{($id == @$coupon->store_id)? 'Selected' : ''}}>{{$item}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("coupons.fields.category_id")) !!}
        <select class="form-control select2" name="category_id" id="category_id">
            <option selected disabled>{{trans('common.select')}}</option>
            @foreach(\App\Models\Category::pluck('title_en', 'id') as $id => $item)
                <option value="{{$id}}" {{($id == @$coupon->category_id)? 'Selected' : ''}}>{{$item}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('coupons.fields.image')) !!}
        <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image[]"  id="images" @if(empty($coupon)) required @endif>
        <!-- <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image[]" multiple id="images" > -->
    </div>
    <div class="form-group col-sm-2 ImagePreview" style="display: none">

        <label class="control-label">
            {{ trans('common.preview_button') }}
        </label>
        <br/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
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
                    <img class="ImagePreview" src="{{ asset(@$coupon->image) }}" style="width: 100% !important; height: 100% !important;"/>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("coupons.fields.active")) !!}<br/>
        <label>
            <input type="hidden" name="active" id="active" value="@if(!empty($coupon)){{$coupon->active}}@endif">
            <input type="checkbox"  class="cls_checkbox" data="active" value="@if(!empty($coupon)){{$coupon->active}}@endif" @if(!empty($coupon) && $coupon->active ==1) checked @endif> {{ ucfirst(trans('common.yes')) }}
        </label>
    </div>

    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.featured_help') }}"></i> &nbsp;{!! Form::label('featured', trans("coupons.fields.featured")) !!}<br/>
        <label>
            <input type="hidden" name="featured" id="featured"  value="@if(!empty($coupon)){{$coupon->featured}}@endif" >
            <input type="checkbox"  class="cls_checkbox" data="featured" value="@if(!empty($coupon)){{$coupon->featured}}@endif" @if(!empty($coupon) && $coupon->featured ==1) checked @endif> {{ ucfirst(trans('common.yes')) }}
        </label>
    </div>
    
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.inslider_help') }}"></i> &nbsp;{!! Form::label('inslider', trans("coupons.fields.inslider")) !!}<br/>
        <label>
            <input type="hidden" name="inslider" id="inslider" value="@if(!empty($coupon)){{$coupon->inslider}}@endif">
            <input type="checkbox"  class="cls_checkbox" data="inslider"  value="@if(!empty($coupon)){{$coupon->inslider}}@endif" @if(!empty($coupon) && $coupon->inslider ==1) checked @endif> {{ ucfirst(trans('common.yes')) }}
        </label>
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
@if(!empty($coupon_details) &&count($coupon_details??[]) >0)
        @foreach($coupon_details as $index => $coupon_detail)
        <div class="col-sm-12 detailRow" id="{{$index}}_rowIndex">
            <input hidden id="{{$index}}_id" name="id" value="{{$coupon_detail->id}}" />
            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('coupons.fields.details.title_en')) !!}
                {!! Form::text('old_details[${index}][title_en]', $coupon_detail->title_en, ['class' => 'form-control','minlength' => 3]) !!}
            </div>
            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_ar_help') }}"></i> &nbsp;{!! Form::label('title_ar', trans('coupons.fields.details.title_ar')) !!}
                {!! Form::text('details[${index}][title_ar]', $coupon_detail->title_ar, ['class' => 'form-control','minlength' => 3]) !!}

            </div>

            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.old_price_help') }}"></i> &nbsp;{!! Form::label('old_price', trans('coupons.fields.old_price')) !!}
                {!! Form::number('old_details[${index}][old_price]', $coupon_detail->old_price, ['class' => 'form-control','minlength' => 3]) !!}

            </div>

            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"  title=" {{ trans('coupons.fields.new_price_help') }}"></i> &nbsp;{!! Form::label('new_price', trans('coupons.fields.new_price')) !!}
                {!! Form::number('old_details[${index}][new_price]', $coupon_detail->new_price, ['class' => 'form-control','minlength' => 3]) !!}

            </div>

            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.start_at_help') }}"></i> &nbsp;{!! Form::label('start_at', trans('coupons.fields.start_at')) !!}
                {!! Form::date('old_details[${index}][start_at]', $coupon_detail->start_at , ['class' => 'form-control']) !!}

            </div>
            <div class="form-group col-sm-2">
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.end_at_help') }}"></i> &nbsp;{!! Form::label('end_at', trans('coupons.fields.end_at')) !!}
                {!! Form::date('old_details[${index}][end_at]', $coupon_detail->end_at, ['class' => 'form-control']) !!}

            </div>
            <div id="${index}_removeCouponDetails" class="removeCouponDetails btn btn-danger" style="border-radius: 10px;border: none;"><i class="fa fa-minus" style="color: #fff"></i></div>

        </div>
        @endforeach
    @else
    <div class="col-sm-12 detailRow" id=" 0_rowIndex">
        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('coupons.fields.details.title_en')) !!}
            {!! Form::text('details[0][title_en]', null, ['class' => 'form-control','minlength' => 3]) !!}
        </div>
        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_ar_help') }}"></i> &nbsp;{!! Form::label('title_ar', trans('coupons.fields.details.title_ar')) !!}
            {!! Form::text('details[0][title_ar]', null, ['class' => 'form-control','minlength' => 3]) !!}
        </div>

        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.old_price_help') }}"></i> &nbsp;{!! Form::label('old_price', trans('coupons.fields.old_price')) !!}
            {!! Form::number('details[0][old_price]', null, ['class' => 'form-control','minlength' => 3]) !!}
        </div>

        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"  title=" {{ trans('coupons.fields.new_price_help') }}"></i> &nbsp;{!! Form::label('new_price', trans('coupons.fields.new_price')) !!}
            {!! Form::number('details[0][new_price]', null, ['class' => 'form-control','minlength' => 3]) !!}
        </div>

        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.start_at_help') }}"></i> &nbsp;{!! Form::label('start_at', trans('coupons.fields.start_at')) !!}
            {!! Form::date('details[0][start_at]', null, ['class' => 'form-control']) !!}
            {{--  {!! Form::text('start_at',strtotime(@$coupon->start_at)), ['class' => 'form-control date']) !!}--}}

        </div>
        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.end_at_help') }}"></i> &nbsp;{!! Form::label('end_at', trans('coupons.fields.end_at')) !!}
            {!! Form::date('details[0][end_at]', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif
</div> -->
<!-- ///////////////////////////////////////////////////////////////////////////////// -->

<div class="">
    <!-- <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"  title=" {{ trans('coupons.fields.discount_help') }}"></i> &nbsp;{!! Form::label('discount', trans('coupons.fields.discount')) !!}
        {!! Form::number('discount', null, ['class' => 'form-control','minlength' => 3 ,'min'=>0]) !!}
    </div> -->
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

<div class="form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.description_ar_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('coupons.fields.description_en')) !!}
    {!! Form::textarea('description_ar', null, ['class' => 'form-control','id'=>'summary-ckeditor']) !!}
</div>

<div class="form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_ar', trans('coupons.fields.description_ar')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control','id'=>'summaryckeditor' ]) !!}
</div>

<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>

        <a href="{{ route('coupons.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>

    <div class="col-sm-1">&nbsp;</div>

        <button id="save" class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>

    <div class="col-sm-1">&nbsp;</div>

</div>

@push('scripts')
<script type="text/javascript">
    // $('#start_at').datetimepicker({
    //     format: 'YYYY-MM-DD',
    //     useCurrent: true,
    //     sideBySide: true
    // });
    // $('#end_at').datetimepicker({
    //     format: 'YYYY-MM-DD',
    //     useCurrent: true,
    //     sideBySide: true
    // })
    $( document ).ready(function() {
        if($("#active").val()=='')$("#active").val(0);
        if($("#featured").val()=='')$("#featured").val(0);
        if($("#inslider").val()=='')$("#inslider").val(0);
        
        $(document).on("change",".cls_checkbox", function(e){
            let id=$(this).attr('data');
            if($(this).is(":checked")){
                $("#"+id).val("1");
            }else{
                $("#"+id).val("0");
            }
           
        });
        @if(empty($coupon))
            $("#code").val();
            $("#save").click(function(event){
                $("#code").val('CP-'+ $("#code").val());
            });
        @endif

        // $("#addCouponDetails").click(function(event){
        //     let index=$(".detailRow").length;
        //     $("#coupon_details_from").append(
        //             `<div class="col-sm-12 detailRow" id="${index}_rowIndex" >
        //                 <div class="form-group col-sm-2">
        //                     <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('coupons.fields.details.title_en')) !!}
        //                     {!! Form::text('details[${index}][title_en]', null, ['class' => 'form-control','minlength' => 3]) !!}
        //                 </div>
        //                 <div class="form-group col-sm-2">
        //                     <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.title_ar_help') }}"></i> &nbsp;{!! Form::label('title_ar', trans('coupons.fields.details.title_ar')) !!}
        //                     {!! Form::text('details[${index}][title_ar]', null, ['class' => 'form-control','minlength' => 3]) !!}
        //                 </div>

        //                 <div class="form-group col-sm-2">
        //                     <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.old_price_help') }}"></i> &nbsp;{!! Form::label('old_price', trans('coupons.fields.old_price')) !!}
        //                     {!! Form::number('details[${index}][old_price]', null, ['class' => 'form-control','minlength' => 3]) !!}
        //                 </div>

        //                 <div class="form-group col-sm-2">
        //                     <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"  title=" {{ trans('coupons.fields.new_price_help') }}"></i> &nbsp;{!! Form::label('new_price', trans('coupons.fields.new_price')) !!}
        //                     {!! Form::number('details[${index}][new_price]', null, ['class' => 'form-control','minlength' => 3]) !!}
        //                 </div>

        //                 <div class="form-group col-sm-2">
        //                     <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.start_at_help') }}"></i> &nbsp;{!! Form::label('start_at', trans('coupons.fields.start_at')) !!}
        //                     {!! Form::date('details[${index}][start_at]', null, ['class' => 'form-control']) !!}
        //                     {{--  {!! Form::text('start_at',strtotime(@$coupon->start_at)), ['class' => 'form-control date']) !!}--}}

        //                 </div>
        //                 <div class="form-group col-sm-2">
        //                 <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.end_at_help') }}"></i> &nbsp;{!! Form::label('end_at', trans('coupons.fields.end_at')) !!}
        //                 {!! Form::date('details[${index}][end_at]', null, ['class' => 'form-control']) !!}
        //                 </div>
                        
        //                 <div id="${index}_removeCouponDetails" class="removeCouponDetails btn btn-danger" style="border-radius: 10px;border: none;"><i class="fa fa-minus" style="color: #fff"></i></div>

        //             </div>
        //             `
        //     );
        // });

        // $(document).on("click",".removeCouponDetails", function(e){
        //     e.preventDefault();
        //     $(this).parent('div').remove(); //remove inout field
        // });
    });

    
</script>
@endpush
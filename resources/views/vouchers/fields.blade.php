<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<input type="hidden" name="type" value="Orders">
<input hidden name='id' value="@if(isset($voucher)) {{$voucher->id}} @endif" />

<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('voucher.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = (isset($voucher))? $voucher->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("voucher.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.store_help') }}"></i> &nbsp;{!! Form::label('stores', trans("coupons.fields.stores")) !!}
    <select class="form-control select2" name="store_id" id="parent" required>
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(\App\Models\Store::limited()->pluck('name_en', 'id') as $id => $item)
            <option value="{{$id}}" {{($id == @$voucher->store_id)? 'Selected' : ''}}>{{$item}}</option>
        @endforeach
    </select>
</div>

<!-- Code Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.code_help') }}"></i> &nbsp;{!! Form::label('code', trans('voucher.fields.code')) !!}
    {!! Form::text('code', null, ['old'=>'' ,'id'=> 'code', 'class' => 'form-control', 'min' => 3, 'readonly' => (isset($voucher) && ($voucher->code != null))? true : false, 'required' => true]) !!}
</div>

<!-- Rate Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('voucher.fields.rate')) !!}
    {!! Form::number('rate', null, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
</div>

<!-- Count Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.count_help') }}"></i> &nbsp;{!! Form::label('count', trans('voucher.fields.count')) !!}
    {!! Form::number('count', null, ['class' => 'form-control', 'min' => 0, 'step' => 1]) !!}
</div>

@if(isset($voucher))
    <!-- Usage Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.usage_help') }}"></i> &nbsp;{!! Form::label('usage', trans('voucher.fields.usage')) !!}
        {!! Form::number('usage', null, ['class' => 'form-control', 'min' => 0, 'step' => 1, 'readonly' => true]) !!}
    </div>
@endif

<!-- Start Date Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.start_date_help') }}"></i> &nbsp;{!! Form::label('start_date', trans('voucher.fields.start_date')) !!}
    {!! Form::date('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.end_date_help') }}"></i> &nbsp;{!! Form::label('end_date', trans('voucher.fields.end_date')) !!}
    {!! Form::date('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

<!-- <div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("coupons.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="@if(!empty($voucher)){{$voucher->active}}@endif">
        <input type="checkbox"  class="cls_checkbox" data="active" value="@if(!empty($voucher)){{$voucher->active}}@endif" @if(!empty($voucher) && $voucher->active ==1) checked @endif> {{ ucfirst(trans('common.yes')) }}
    </label>
</div> -->
<div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.editors') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('voucher.fields.description_en')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control', 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($voucher))? $voucher->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("voucher.fields.$input_name")) !!}
        {!! Form::textarea($input_name, null, ['class' => 'form-control', 'required' => true]) !!}
    </div>
@endforeach


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('vouchers.list')
        <a href="{{ route('vouchers.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['vouchers.edit', 'vouchers.create'])
    <button id="save" class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('vouchers.delete')
        @if(isset($voucher))
            <a href="{{ route('vouchers.destroy', $voucher->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>
@push('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        @if(empty($voucher))
             $("#code").val('');
            $("#save").click(function(event){
                $("#code").val('VCH-'+ $("#code").val());
            });
        @endif


        // if($("#active").val()=='')$("#active").val(0);        
        // $(document).on("change",".cls_checkbox", function(e){
        //     let id=$(this).attr('data');
        //     if($(this).is(":checked")){$("#"+id).val("1");}else{$("#"+id).val("0");}
        // });

    });
</script>
@endpush
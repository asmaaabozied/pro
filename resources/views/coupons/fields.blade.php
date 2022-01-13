<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>
<!-- Title En Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('coupon.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = (isset($coupon))? $coupon->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("coupon.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Code Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.code_help') }}"></i> &nbsp;{!! Form::label('code', trans('coupon.fields.code')) !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'min' => 0, 'disabled' => (isset($coupon) && ($coupon->code != null))? true : false, 'required' => true]) !!}
</div>

<!-- Rate Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('coupon.fields.rate')) !!}
    {!! Form::number('rate', null, ['class' => 'form-control', 'min' => 0]) !!}
</div>

<!-- Count Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.count_help') }}"></i> &nbsp;{!! Form::label('count', trans('coupon.fields.count')) !!}
    {!! Form::number('count', null, ['class' => 'form-control', 'min' => 0, 'step' => 1]) !!}
</div>

@if(isset($coupon))
    <!-- Usage Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.usage_help') }}"></i> &nbsp;{!! Form::label('usage', trans('coupon.fields.usage')) !!}
        {!! Form::number('usage', null, ['class' => 'form-control', 'min' => 0, 'step' => 1, 'readonly' => true]) !!}
    </div>
@endif

<!-- Start Date Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.start_date_help') }}"></i> &nbsp;{!! Form::label('start_date', trans('coupon.fields.start_date')) !!}
    {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

<!-- End Date Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.end_date_help') }}"></i> &nbsp;{!! Form::label('end_date', trans('coupon.fields.end_date')) !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
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

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('coupon.fields.description_en')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control', 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($coupon))? $coupon->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupon.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("coupon.fields.$input_name")) !!}
        {!! Form::textarea($input_name, null, ['class' => 'form-control', 'required' => true]) !!}
    </div>
@endforeach


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('coupons.list')
        <a href="{{ route('coupons.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['coupons.edit', 'coupons.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('coupons.delete')
        @if(isset($coupon))
            <a href="{{ route('coupons.destroy', $coupon->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

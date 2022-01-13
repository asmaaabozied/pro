<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Type Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.type_help') }}"></i> &nbsp;{!! Form::label('type', trans('voucher.fields.type')) !!}<br/>
    <div class="field_show text-center" style="background: {{array_search($voucher->type, trans('voucher.type'))}}"> <span style="color: white">{{ $voucher->type }}</span></div>
</div>

<!-- Title En Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('voucher.fields.title_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $voucher->title_en }}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_title = 'title_' . $system_language;
    $input_value = (isset($voucher))? $voucher->$input_title : ''
    ?>
    <div class="col-sm-3 form-group">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.'.$input_title.'_help') }}"></i> &nbsp;{!! Form::label($input_title, trans("voucher.fields.$input_title")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $input_value }}</div>
    </div>
@endforeach

<div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('coupons.fields.store_help') }}"></i> &nbsp;{!! Form::label('stores', trans("coupons.fields.stores")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $voucher->store->$name}}</div>
    </div>

<!-- Code Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.code_help') }}"></i> &nbsp;{!! Form::label('code', trans('voucher.fields.code')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $voucher->code }}</div>
</div>

<!-- Rate Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('voucher.fields.rate')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $voucher->rate }}</div>
</div>

<!-- Count Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.count_help') }}"></i> &nbsp;{!! Form::label('count', trans('voucher.fields.count')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $voucher->count }}</div>
</div>

<!-- Count Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.usage_help') }}"></i> &nbsp;{!! Form::label('usage', trans('voucher.fields.usage')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $voucher->usage }}</div>
</div>

<!-- Start Date Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.start_date_help') }}"></i> &nbsp;{!! Form::label('start_date', trans('voucher.fields.start_date')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ date('Y-m-d',strtotime($voucher->start_date)) }}</div>
</div>

<!-- End Date Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.end_date_help') }}"></i> &nbsp;{!! Form::label('end_date', trans('voucher.fields.end_date')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ date('Y-m-d',strtotime($voucher->start_date)) }}</div>
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
<div class="col-sm-3 form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('voucher.fields.description_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $voucher->description_en ?></div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $voucher->$input_name;
    ?>
    <div class="col-sm-3 form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('voucher.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("voucher.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>
    </div>
@endforeach

<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('vouchers.list')
        <a href="{{ route('vouchers.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('vouchers.edit')
        <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('vouchers.delete')
        <a href="{{ route('vouchers.destroy', $voucher->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>
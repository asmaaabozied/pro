<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.languages') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<div class="form-group col-sm-12">
    <label for="en" class="control-label">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('common.active_languages_help') }}"></i> &nbsp;{{ trans('common.active_languages') }}
    </label>

    <div class="checkbox">
        <label>
            <input type="hidden" id="en" name="en" value="0" checked>
            <input type="checkbox" id="en" name="en" @if(@$subscription->en) checked @endif value = 1> {{ strtoupper('en') }}
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @foreach($system_languages as $system_language)
            <label>
                <input type="hidden" id="{{$system_language}}" name="{{$system_language}}" value="0" checked>
                <input type="checkbox" id="{{$system_language}}" name="{{$system_language}}" @if(@$subscription->$system_language) checked @endif value="1"> {{ strtoupper($system_language) }}
            </label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
    </div>
</div>

<div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Title En Field -->
<div class="form-group col-sm-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('subscription.fields.title_en')) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = (isset($subscription))? $subscription->$input_name : ''
    ?>
    <div class="form-group col-sm-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("subscription.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Price Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.price_help') }}"></i> &nbsp;{!! Form::label('price', trans('subscription.fields.price')) !!}
    {!! Form::number('price', null, ['class' => 'form-control', 'min' => 0, 'step' => 0.1,'required' => true]) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.duration_help') }}"></i> &nbsp;{!! Form::label('duration', trans('subscription.fields.duration')) !!}
    {!! Form::number('duration', null, ['class' => 'form-control', 'min' => 0, 'step' => 1,'required' => true]) !!}
</div>

<!-- max_product Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.max_product_help') }}"></i> &nbsp;{!! Form::label('duration', trans('subscription.fields.max_product')) !!}
    {!! Form::number('max_product', null, ['class' => 'form-control', 'min' => 0, 'step' => 1,'required' => true]) !!}
</div>
<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("subscription.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active_check" @if(@$subscription->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('subscription.fields.description_en')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control', 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($subscription))? $subscription->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('subscription.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("subscription.fields.$input_name")) !!}
        {!! Form::textarea($input_name, $input_value, ['class' => 'form-control', 'required' => true]) !!}
    </div>
@endforeach


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('subscriptions.list')
        <a href="{{ route('subscriptions.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['subscriptions.edit', 'subscriptions.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('subscriptions.delete')
        @if(isset($subscription))
            <a href="{{ route('subscriptions.destroy', $subscription->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

@push('scripts')
<script type="text/javascript">
    
    $( document ).ready(function() {
        $(document).on("change","#active_check", function(e){
            if($("#active_check").is(":checked")){$("#active").val("1");}
            else{$("#active").val("0");}
        });
    });
</script>
@endpush
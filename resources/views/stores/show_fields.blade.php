<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Store Type Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.store_type_help') }}"></i> &nbsp;{!! Form::label('store_type', trans("store.fields.store_type")) !!}
    <?php $type = 'type_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $store->type->$type }}</div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('stores.fields.name_en_help') }}"></i> &nbsp;{!! Form::label('name_en', trans('store.fields.name_en')) !!}<br/>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $store->name_en }}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'name_' . $system_language;
    $input_value = (isset($store))? $store->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("store.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $input_value }}</div>
    </div>
@endforeach

<!-- Phone Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('stores.fields.phone_help') }}"></i> &nbsp;{!! Form::label('phone', trans('store.fields.phone')) !!}<br/>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $store->phone }}</div>
</div>

<!-- lat Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('stores.fields.lat_help') }}"></i> &nbsp;{!! Form::label('lat', trans('store.fields.lat')) !!}<br/>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $store->lat }}</div>
</div>

<!-- long Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('stores.fields.long_help') }}"></i> &nbsp;{!! Form::label('long', trans('store.fields.long')) !!}<br/>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $store->long }}</div>
</div>

<!-- Status Field -->
<div class="col-sm-2 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.status_help') }}"></i> &nbsp;{!! Form::label('status', trans('store.fields.status')) !!}<br/>
    <div class="field_show text-center" style="background: {{array_search($store->status, trans('store.store_status'))}}"> <span style="color: white">{{ $store->status }}</span></div>
</div>

<!-- Owner Field -->
<div class="col-sm-3 form-group">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.owner_id_help') }}"></i> &nbsp;{!! Form::label('owner_id', trans('store.fields.owner_id')) !!}<br/>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><span>{{ $store->owner->name }}</span></div>
</div>

<!-- Image Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('store.fields.image')) !!}
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
                <img class="ImagePreview" src="{{ asset($store->image) }}" style="width: 100% !important; height: 100% !important;"/>
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
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.activated_help') }}"></i> &nbsp;{!! Form::label('activated', trans("store.fields.activated")) !!}
    <h4>
        @if($store->activated)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('store.fields.description_en')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $store->description_en ?></div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $store->$input_name;
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("store.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>
    </div>
@endforeach

<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('store.fields.terms_and_policy.header') }}</b></h4>
    </div>
    <div class="col-sm-12 table-responsive">
        <table class="table-responsive table">
            <thead>
            <tr>
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.title_en_help') }}"></i> &nbsp;{{ trans('store.fields.terms_and_policy.title_en') }}</b></th>
                @foreach($system_languages as $system_language)
                    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.title_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("store.fields.terms_and_policy.title_$system_language") }}</b></th>
                @endforeach
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.description_en_help') }}"></i> &nbsp;{{ trans('store.fields.terms_and_policy.description_en') }}</b></th>
                @foreach($system_languages as $system_language)
                    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.description_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("store.fields.terms_and_policy.description_$system_language") }}</b></th>
                @endforeach
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.active_help') }}"></i> &nbsp;{{ trans('store.fields.terms_and_policy.active') }}</b></th>
                <th><b>{{ trans('common.languages') }}</b></th>
            </tr>
            </thead>
            <tbody>
            @foreach($store->termsAndPolicies as $paragraph)
                <tr>
                    <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $paragraph->title_en }}</div></td>
                    @foreach($system_languages as $system_language)
                        <?php $input_name = 'title_' . $system_language; ?>
                            <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $paragraph->$input_name }}</div></td>
                    @endforeach
                    <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><?php echo $paragraph->description_en ?></div></td>
                    @foreach($system_languages as $system_language)
                        <?php $input_name = 'description_' . $system_language; ?>
                            <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><?php echo $paragraph->$input_name ?></div></td>
                    @endforeach
                    <td>
                        @if($paragraph->activated)
                            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
                        @else
                            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
                        @endif
                    </td>
                    <td class="language{{$paragraph->id}}">
                        <div class="checkbox">
                            @if($paragraph->en)
                                {{ strtoupper('en') }} <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
                            @else
                                {{ strtoupper('en') }} <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @foreach($system_languages as $system_language)
                                @if($paragraph->$system_language)
                                    {{ strtoupper($system_language) }} <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
                                @else
                                    {{ strtoupper($system_language) }} <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
                                @endif
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('stores.list')
        <a href="{{ route('stores.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('stores.edit')
        <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('stores.delete')
        <a href="{{ route('stores.destroy', $store->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>


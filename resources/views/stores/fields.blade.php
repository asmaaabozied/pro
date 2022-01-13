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
    <select class="form-control select2" name="store_type" id="store_type">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($types as $id => $type)
            <option value="{{$id}}" {{($id == @$store->store_type)? 'Selected' : ''}}>{{$type}}</option>
        @endforeach
    </select>
</div>

<!-- Name Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.name_en_help') }}"></i> &nbsp;{!! Form::label('name_en', trans('store.fields.name_en')) !!}<br/>
    {!! Form::text('name_en', null, ['class' => 'form-control']) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'name_' . $system_language;
    $input_value = (isset($storeType))? $storeType->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("store.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Phone Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.phone_help') }}"></i> &nbsp;{!! Form::label('phone', trans('store.fields.phone')) !!}<br/>
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>


<!-- lat Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.lat_help') }}"></i> &nbsp;{!! Form::label('lat', trans('store.fields.lat')) !!}<br/>
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<!-- long Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.long_help') }}"></i> &nbsp;{!! Form::label('long', trans('store.fields.long')) !!}<br/>
    {!! Form::text('long', null, ['class' => 'form-control']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.status_help') }}"></i> &nbsp;{!! Form::label('status', trans('store.fields.status')) !!}<br/>
    <select class="form-control select2" name="status" id="status">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach(trans('store.store_status') as $color => $status)
            <option value="{{$status}}" {{($status == @$store->status)? 'Selected' : ''}}>{{$status}}</option>
        @endforeach
    </select>
</div>

<!-- Store Owner Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.owner_id_help') }}"></i> &nbsp;{!! Form::label('owner_id', trans("store.fields.owner_id")) !!}
    <select class="form-control select2" name="owner_id" id="owner_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($owners as $id => $owner)
            <option value="{{$id}}" {{($id == @$store->owner_id)? 'Selected' : ''}}>{{$owner}}</option>
        @endforeach
    </select>
</div>

<!-- Image Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('store.fields.image')) !!}
    <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image" id="image" @if(! isset($store)) required @endif>
</div>
<div class="form-group col-sm-3 ImagePreview" style="display: none">

    <label class="control-label">
        {{ trans('common.preview_button') }}
    </label>
    <br/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
</div>
@if(@$store != null)
    <div class="form-group col-sm-3" style="display: {{(isset($store))? 'block' : 'none'}}">

        <label class="control-label">
            {{ trans('common.current_image') }}
        </label>
        <br/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
@endif
<div id="current_image" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>{{ trans('common.current_image') }}</b></h4>
            </div>
            <div class="modal-body text-center" id="data" style="display: block;">
                <img class="ImagePreview" src="{{ asset(@$store->image) }}" style="width: 100% !important; height: 100% !important;"/>
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.activated_help') }}"></i> &nbsp;{!! Form::label('activated', trans("store.fields.activated")) !!}<br/>
    <label>
        <input type="hidden" name="activated" id="activated" value="0" checked>
        <input type="checkbox" name="activated" id="activated" @if(@$store->activated) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('store.fields.description_en')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control','id'=>'summaryckeditor' , 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($store))? $store->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("store.fields.$input_name")) !!}
        {!! Form::textarea($input_name, $input_value, ['class' => 'form-control','id'=>'summary-ckeditor' ,'required' => true]) !!}

{{--                {!! Form::textarea('description_ar', null, ['class' => 'form-control','id'=>'summary-ckeditor' ,'required' => true]) !!}--}}

    </div>
@endforeach

{{--<div class="col-sm-12">--}}
{{--        <hr style="border-color: #3c8dbcab"/>--}}
{{--    <div class="col-sm-12" style="background: #3c8dbcab;">--}}
{{--        <h4 style="color: #222d32"><b>{{ trans('store.fields.terms_and_policy.header') }}</b></h4>--}}
{{--    </div>--}}
{{--    <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--    @foreach($system_languages as $i => $system_language)--}}
{{--        <input type="hidden" value="{{$system_language}}" name="system_language[{{$i}}]" class="system_languages">--}}
{{--    @endforeach--}}
{{--    <div class="col-sm-12 table-responsive">--}}
{{--        <div class="alert alert-success" style="display: none;" id="paragraphSuccess"><div id="paragraphMessage">{{ trans('common.messages.deleted') }}</div> </div>--}}
{{--        <table id="addParagraphTable" class="table-responsive table well">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.title_en_help') }}"></i> &nbsp;{{ trans('store.fields.terms_and_policy.title_en') }}</b></th>--}}
{{--                @foreach($system_languages as $system_language)--}}
{{--                    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.title_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("store.fields.terms_and_policy.title_$system_language") }}</b></th>--}}
{{--                @endforeach--}}
{{--                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.description_en_help') }}"></i> &nbsp;{{ trans('store.fields.terms_and_policy.description_en') }}</b></th>--}}
{{--                @foreach($system_languages as $system_language)--}}
{{--                    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.description_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("store.fields.terms_and_policy.description_$system_language") }}</b></th>--}}
{{--                @endforeach--}}
{{--                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('store.fields.terms_and_policy.active_help') }}"></i> &nbsp;{{ trans('store.fields.terms_and_policy.active') }}</b></th>--}}
{{--                <th><b>{{ trans('common.languages') }}</b></th>--}}
{{--                <th><b>{{ trans('common.delete') }}</b></th>--}}
{{--                @if(isset($store))--}}
{{--                    <th><button type="button" class="btn btn-xs btn-success addParagraph" value="{{$store->id}}"><i class="fa fa-plus"></i> </button></th>--}}
{{--                @else--}}
{{--                    <th><button type="button" class="btn btn-xs btn-success addNewParagraph"><i class="fa fa-plus"></i> </button></th>--}}
{{--                @endif--}}
{{--                <th><input type="hidden" value="{{ (key_exists('counter', request()->input()))? request()->input('counter') : 0 }}" name="counter" id="counter"></th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @if(isset($store))--}}
{{--                @foreach($store->termsAndPolicies as $paragraph)--}}
{{--                    <tr class="{{$paragraph->id}}">--}}
{{--                        <td class="title_en{{$paragraph->id}}"><input type="text" class="form-control title" placeholder="{{ trans('store.terms_and_policy.title_en') }}" value="{{$paragraph->title_en}}" row_id="{{$paragraph->id}}" attribute="title_en"></td>--}}
{{--                        @foreach($system_languages as $system_language)--}}
{{--                            <?php $input_name = 'title_' . $system_language; ?>--}}
{{--                            <td class="title_{{$system_language}}{{$paragraph->id}}"><input type="text" class="form-control title" placeholder="{{ trans("store.terms_and_policy.title_$system_language") }}" value="{{$paragraph->$input_name}}" row_id="{{$paragraph->id}}" attribute="title_{{$system_language}}"></td>--}}
{{--                        @endforeach--}}
{{--                        <td class="description_en{{$paragraph->id}}"><textarea rows="7"  class="form-control description" placeholder="{{ trans('store.terms_and_policy.description_en') }}" row_id="{{$paragraph->id}}" attribute="description_en">{{$paragraph->description_en}}</textarea></td>--}}
{{--                        @foreach($system_languages as $system_language)--}}
{{--                            <?php $input_name = 'description_' . $system_language; ?>--}}
{{--                            <td class="description_{{$system_language}}{{$paragraph->id}}"><textarea rows="7" cols="7" class="form-control description" placeholder="{{ trans("store.terms_and_policy.description_$system_language") }}" row_id="{{$paragraph->id}}" attribute="description_{{$system_language}}">{{$paragraph->$input_name}}</textarea></td>--}}
{{--                        @endforeach--}}
{{--                        <td class="active{{$paragraph->id}}">--}}
{{--                            <div class="checkbox">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" class="activeness" attribute="active" row_id="{{$paragraph->id}}" @if($paragraph->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td class="language{{$paragraph->id}}">--}}
{{--                            <div class="checkbox">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" class="language" attribute="en" row_id="{{$paragraph->id}}" @if($paragraph->en) checked @endif value="1"> {{ strtoupper('en') }}--}}
{{--                                </label>--}}
{{--                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                                @foreach($system_languages as $system_language)--}}
{{--                                    <label>--}}
{{--                                        <input type="checkbox" class="language"  attribute="{{$system_language}}" row_id="{{$paragraph->id}}" @if($paragraph->$system_language) checked @endif value="1"> {{ strtoupper($system_language) }}--}}
{{--                                    </label>--}}
{{--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td><button type="button" class="btn btn-xs btn-danger deleteParagraph" value="{{$paragraph->id}}"><i class="fa fa-remove"></i> </button></td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('stores.list')
        <a href="{{ route('stores.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['stores.edit', 'stores.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('stores.delete')
        @if(isset($store))
            <a href="{{ route('stores.destroy', $store->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

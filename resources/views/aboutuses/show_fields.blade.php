{{--<div class="field_table_show"><div class="col-sm-12">--}}
{{--    <div class="field_table_show"><div class="col-sm-12" style="background: #3c8dbcab;">--}}
{{--        <h4 style="color: #222d32">--}}
{{--            <b>{{ trans('aboutus.table') }}</b>--}}
{{--            --}}{{--<button type="button" class="btn btn-xs btn-success addParagraph pull-right"><i class="fa fa-plus"></i> {{trans('common.new')}}</button>--}}
{{--        </h4>--}}

    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="slug" value="{{ $slug }}">
    @foreach($system_languages as $i => $system_language)
        <input type="hidden" value="{{$system_language}}" name="system_language[{{$i}}]" class="system_languages">
    @endforeach
    <div class="field_table_show"><div class="col-sm-12 table-responsive">
        <div class="alert alert-success" style="display: none;" id="paragraphSuccess"><div id="paragraphMessage">{{ trans('common.messages.deleted') }}</div> </div>
        <table id="addParagraphTable" class="table-responsive table well">
            <tbody>
            @if(isset($aboutUs))
                @foreach($aboutUs as $paragraph)
{{--                    <tr>--}}
{{--                        <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.title_en') }}</b></th>--}}
{{--                        @foreach($system_languages as $system_language)--}}
{{--                            <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("aboutus.fields.title_$system_language") }}</b></th>--}}
{{--                        @endforeach--}}
{{--                        <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.active_help') }}"></i> &nbsp;{{ trans('aboutus.fields.active') }}</b></th>--}}
{{--                        <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('aboutus.fields.image')) !!}</b></th>--}}
{{--                        --}}{{--<th><b>{{ trans('common.delete') }}</b></th>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td><div class="field_table_show"><div class="col-sm-1">&nbsp;</div>{{ $paragraph->title_en }}</div></td>--}}
{{--                        @foreach($system_languages as $system_language)--}}
{{--                            <?php $input_name = 'title_' . $system_language; ?>--}}
{{--                            <td><div class="field_table_show"><div class="col-sm-1">&nbsp;</div>{{ $paragraph->$input_name }}</div></td>--}}
{{--                        @endforeach--}}
{{--                        <td>--}}
{{--                            <div class="checkbox">--}}
{{--                                @if($paragraph->active)--}}
{{--                                    <div><div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>--}}
{{--                                @else--}}
{{--                                    <div><div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <div class="form-group col-sm-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        --}}{{--<td>@if(! in_array($paragraph->id, [1,2]))<button type="button" class="btn btn-danger deleteParagraph" value="{{$paragraph->id}}"><i class="fa fa-remove"></i> </button>@endif</td>--}}
{{--                    </tr>--}}
                    <tr>
                        <th colspan="2"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.description_en') }}</b></th>
                        @foreach($system_languages as $system_language)
                            <th colspan="2"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("aboutus.fields.description_$system_language") }}</b></th>
                        @endforeach
                    </tr>
                    <tr>
                        <td colspan="2"><div class="field_table_show"><div class="col-sm-1">&nbsp;</div>{{ $paragraph->description_en }}</div></td>
                        @foreach($system_languages as $system_language)


                            <?php $input_name = 'description_' . $system_language; ?>
                            <td colspan="2"><div class="field_table_show"><div class="col-sm-1">&nbsp;</div>{{ $paragraph->$input_name }}</div></td>
                        @endforeach
                    </tr>

<tr>
{{--    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('aboutus.fields.image')) !!}</b>  {!! Form::file('image', trans('aboutus.fields.image')) !!}</th>--}}
{{--    <td>--}}
{{--                                <div class="form-group col-sm-2">--}}
{{--                                    <input type="file" name="image">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
</tr>




                    <tr class="row4{{$paragraph->id}}"><td colspan="4" style="background: #3c8dbcab"></td></tr>

                @endforeach
            @endif
            </tbody>
        </table>
        <div id="current_image" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>{{ trans('common.current_image') }}</b></h4>
                    </div>
                    <div class="modal-body text-center" id="data" style="display: block;">
                        <img class="ImagePreview" src="{{ asset(@$paragraph->image) }}" style="width: 100% !important; height: 100% !important;"/>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Show Field -->
<div class="form-group col-sm-12">
{{--    @can('aboutuses.edit')--}}
        <a href="{{ route('aboutuses.edit', $id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
{{--    @endcan--}}
</div>

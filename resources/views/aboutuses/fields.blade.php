<div class="col-sm-12">
{{--    <div class="col-sm-12" style="background: #3c8dbcab;">--}}
{{--            <h4 style="color: #222d32">--}}
{{--                <b>{{ trans('aboutus.table') }}</b>--}}
{{--                --}}{{--<button type="button" class="btn btn-xs btn-success addParagraph pull-right"><i class="fa fa-plus"></i> {{trans('common.new')}}</button>--}}
{{--            </h4>--}}

    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="slug" value="{{ $slug }}">
    @foreach($system_languages as $i => $system_language)
        <input type="hidden" value="{{$system_language}}" name="system_language[{{$i}}]" class="system_languages">
    @endforeach
    <div class="col-sm-12 table-responsive">
        <div class="alert alert-success" style="display: none;" id="paragraphSuccess"><div id="paragraphMessage">{{ trans('common.messages.deleted') }}</div> </div>
        <table id="addParagraphTable" class="table-responsive table well">
            <tbody>
            @if(isset($aboutUs))
                @foreach($aboutUs as $paragraph)


                      <div class="form-group row">
                          <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image" id="image" class="image form-group col-sm-5" attribute="image" row_id="{{$paragraph->id}}">
                          <div class="ImagePreview form-group col-sm-1" style="display: none">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
                          </div>
                      </div>




{{--                    <tr class="row0{{$paragraph->id}}">--}}
{{--                        <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.title_en') }}</b></th>--}}
{{--                        @foreach($system_languages as $system_language)--}}
{{--                            <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("aboutus.fields.title_$system_language") }}</b></th>--}}
{{--                        @endforeach--}}
{{--                        <th style="display: none"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.active_help') }}"></i> &nbsp;{{ trans('aboutus.fields.active') }}</b></th>--}}
{{--                        <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('aboutus.fields.image')) !!}</b></th>--}}
{{--                        --}}{{--<th><b>{{ trans('common.delete') }}</b></th>--}}
{{--                    </tr>--}}
{{--                    <tr class="row1{{$paragraph->id}}">--}}
{{--                        <td class="title_en{{$paragraph->id}}"><input type="text" class="form-control title" placeholder="{{ trans('aboutus.fields.title_en') }}" value="{{$paragraph->title_en}}" row_id="{{$paragraph->id}}" attribute="title_en"></td>--}}
{{--                        @foreach($system_languages as $system_language)--}}
{{--                            <?php $input_name = 'title_' . $system_language; ?>--}}
{{--                            <td class="title_{{$system_language}}{{$paragraph->id}}"><input type="text" class="form-control title" placeholder="{{ trans("aboutus.fields.title_$system_language") }}" value="{{$paragraph->$input_name}}" row_id="{{$paragraph->id}}" attribute="title_{{$system_language}}"></td>--}}
{{--                        @endforeach--}}
{{--                        <td class="active{{$paragraph->id}}" style="display: none">--}}
{{--                            <div class="checkbox">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox" class="activeness" attribute="active" row_id="{{$paragraph->id}}" @if($paragraph->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <div class="form-group row">--}}
{{--                                <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="image" id="image" class="image form-group col-sm-5" attribute="image" row_id="{{$paragraph->id}}">--}}
{{--                                <div class="ImagePreview form-group col-sm-1" style="display: none">--}}
{{--                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        --}}{{--<td>@if(! in_array($paragraph->id, [1,2]))<button type="button" class="btn btn-danger deleteParagraph" value="{{$paragraph->id}}"><i class="fa fa-remove"></i> </button>@endif</td>--}}
{{--                    </tr>--}}
                    <tr class="row2{{$paragraph->id}}">
                        <th colspan="2"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.description_en') }}</b></th>
                        @foreach($system_languages as $system_language)
                            <th colspan="2"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("aboutus.fields.description_$system_language") }}</b></th>
                        @endforeach
                    </tr>
                    <tr class="row3{{$paragraph->id}}">
                        <td colspan="2" class="description_en{{$paragraph->id}}"><textarea rows="7"  id="summary-ckeditor"  class="form-control description" placeholder="{{ trans('aboutus.fields.description_en') }}" row_id="{{$paragraph->id}}" attribute="description_en">{{$paragraph->description_en}}</textarea></td>
                        @foreach($system_languages as $system_language)
                            <?php $input_name = 'description_' . $system_language; ?>
                            <td colspan="2" class="description_{{$system_language}}{{$paragraph->id}}"><textarea rows="7"    id="summaryckeditor"   cols="7" class="form-control description summary-ckeditor" placeholder="{{ trans("aboutus.fields.description_$system_language") }}" row_id="{{$paragraph->id}}" attribute="description_{{$system_language}}">{{$paragraph->$input_name}}</textarea></td>
                        @endforeach
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
{{--    @can('aboutuses.show')--}}
        <a href="{{ route('aboutuses.show', $id) }}" class="btn btn-primary col-sm-2"><i class="fa fa-eye"></i> {{ trans('common.show') }}</a>
{{--    @endcan--}}
</div>

<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('aboutus.table') }}</b></h4>
    </div>
    <div class="col-sm-12 table-responsive">
        <table class="table-responsive table">
            <thead>
            <tr>
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.image_help') }}"></i> &nbsp;{{ trans('aboutus.fields.image') }}</b></th>
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.title_en') }}</b></th>
                @foreach($system_languages as $system_language)
                    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("aboutus.fields.title_$system_language") }}</b></th>
                @endforeach
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.description_en') }}</b></th>
                @foreach($system_languages as $system_language)
                    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("aboutus.fields.description_$system_language") }}</b></th>
                @endforeach
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.active_help') }}"></i> &nbsp;{{ trans('aboutus.fields.active') }}</b></th>
            </tr>
            </thead>
            <tbody>
            @foreach($aboutUs as $paragraph)
                <tr>
                    <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><img src="{{asset($paragraph->image)}}" class="img-thumbnail" height="100px" width="100px" onerror="this.onerror=null; this.src='{{asset('images/default-image.jpg')}}'"/></div></td>
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
                        @if($paragraph->active)
                            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
                        @else
                            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
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


<!-- Modify Field -->
<div class="form-group col-sm-12">
    @can('aboutuses.edit')
        <a href="{{ route('aboutuses.edit', $id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
</div>


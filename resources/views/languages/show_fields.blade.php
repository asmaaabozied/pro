<div class="col-sm-12">
        <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Prefix Field -->
<div class="form-group col-sm-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('language.fields.prefix_help') }}"></i> &nbsp;{!! Form::label('prefix', trans('language.fields.prefix')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $language->prefix ?></div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('languages.list')
        <a href="{{ route('languages.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('languages.edit')
        <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('languages.delete')
        @if($language->prefix != 'en')
            <a href="{{ route('languages.destroy', $language->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>


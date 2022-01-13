<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productsFavourite.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', trans('productsFavourite.fields.user_id')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $productsFavourite->user->name }}</div>
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productsFavourite.fields.product_id_help') }}"></i> &nbsp;{!! Form::label('product_id', trans('productsFavourite.fields.product_id')) !!}
    <?php $title = 'title_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $productsFavourite->product->$title }}</div>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('productsFavourites.list')
        <a href="{{ route('productsFavourites.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('productsFavourites.edit')
        <a href="{{ route('productsFavourites.edit', $productsFavourite->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('productsFavourites.delete')
        <a href="{{ route('productsFavourites.destroy', $productsFavourite->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>

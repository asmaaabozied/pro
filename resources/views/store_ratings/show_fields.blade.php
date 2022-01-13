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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', trans('storeRating.fields.user_id')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeRating->user->name }}</div>
</div>

<!-- Store Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.store_id_help') }}"></i> &nbsp;{!! Form::label('store_id', trans('storeRating.fields.store_id')) !!}
    <?php $name = 'name_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $storeRating->store->$name }}</div>
</div>

<!-- Rate Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('storeRating.fields.rate')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>
        @for($i = 1; $i<=5; $i++)
            @if($i <= $storeRating->rate)
                <span class="fa fa-star" style="color: #c69500"></span>
            @else
                <span class="fa fa-star-o"></span>
            @endif
        @endfor
    </div>
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

<!-- Review Field -->
<div class="form-group col-sm-9 col-lg-9">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('storeRating.fields.review_help') }}"></i> &nbsp;{!! Form::label('review', trans('storeRating.fields.review')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $storeRating->review ?></div>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('storeRatings.list')
        <a href="{{ route('storeRatings.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('storeRatings.edit')
        <a href="{{ route('storeRatings.edit', $storeRating->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('storeRatings.delete')
        <a href="{{ route('storeRatings.destroy', $storeRating->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>

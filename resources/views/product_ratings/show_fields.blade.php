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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productRating.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', trans('productRating.fields.user_id')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $productRating->user->name }}</div>
</div>

<!-- product Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productRating.fields.product_id_help') }}"></i> &nbsp;{!! Form::label('product_id', trans('productRating.fields.product_id')) !!}
    <?php $title = 'title_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $productRating->product->$title }}</div>
</div>

<!-- Rate Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productRating.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('productRating.fields.rate')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>
        @for($i = 1; $i<=5; $i++)
            @if($i <= $productRating->rate)
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
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productRating.fields.review_help') }}"></i> &nbsp;{!! Form::label('review', trans('productRating.fields.review')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $productRating->review ?></div>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('productRatings.list')
        <a href="{{ route('productRatings.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('productRatings.edit')
        <a href="{{ route('productRatings.edit', $productRating->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('productRatings.delete')
        <a href="{{ route('productRatings.destroy', $productRating->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>
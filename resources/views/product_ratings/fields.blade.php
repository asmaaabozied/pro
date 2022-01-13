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
    <select class="form-control select2" name="user_id" id="user_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($users as $id => $user)
            <option value="{{$id}}" {{($id == @$productRating->user_id)? 'Selected' : ''}}>{{$user}}</option>
        @endforeach
    </select>
</div>

<!-- product Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productRating.fields.product_id_help') }}"></i> &nbsp;{!! Form::label('product_id', trans('productRating.fields.product_id')) !!}
    <select class="form-control select2" name="product_id" id="product_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($products as $id => $product)
            <option value="{{$id}}" {{($id == @$productRating->product_id)? 'Selected' : ''}}>{{$product}}</option>
        @endforeach
    </select>
</div>

<!-- Rate Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productRating.fields.rate_help') }}"></i> &nbsp;{!! Form::label('rate', trans('productRating.fields.rate')) !!}
    {!! Form::number('rate', null, ['class' => 'form-control', 'step' => 0.5, 'min' => 0, 'max' => 5]) !!}
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
    {!! Form::textarea('review', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('productRatings.list')
        <a href="{{ route('productRatings.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['productRatings.edit', 'productRatings.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('productRatings.delete')
        @if(isset($productRating))
            <a href="{{ route('productRatings.destroy', $productRating->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

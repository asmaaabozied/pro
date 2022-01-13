<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productsFavourite.fields.product_id_help') }}"></i> &nbsp;{!! Form::label('product_id', trans('productsFavourite.fields.product_id')) !!}
    <select class="form-control select2" name="product_id" id="product_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($products as $id => $product)
            <option value="{{$id}}" {{($id == @$productsFavourite->product_id)? 'Selected' : ''}}>{{$product}}</option>
        @endforeach
    </select>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('productsFavourite.fields.user_id_help') }}"></i> &nbsp;{!! Form::label('user_id', 'User Id:') !!}
    <select class="form-control select2" name="user_id" id="user_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($users as $id => $user)
            <option value="{{$id}}" {{($id == @$productsFavourite->user_id)? 'Selected' : ''}}>{{$user}}</option>
        @endforeach
    </select>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('productsFavourites.list')
        <a href="{{ route('productsFavourites.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['productsFavourites.edit', 'productsFavourites.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('productsFavourites.delete')
        @if(isset($productsFavourite))
            <a href="{{ route('productsFavourites.destroy', $productsFavourite->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>

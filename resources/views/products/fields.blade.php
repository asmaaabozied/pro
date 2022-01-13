<input type="hidden" id="en" name="en" value="1">
@foreach($system_languages as $i => $system_language)
    <input type="hidden" id="{{$system_language}}" name="{{$system_language}}" value="1">
@endforeach

<div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Store Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.store_id_help') }}"></i> &nbsp;{!! Form::label('store_id', trans("product.fields.store_id")) !!}
    <select class="form-control select2" name="store_id" id="store_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($stores as $id => $store)
            <option value="{{$id}}" {{($id == @$product->store_id)? 'Selected' : ''}}>{{$store}}</option>
        @endforeach
    </select>
</div>

<!-- Category Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("product.fields.category_id")) !!}
    <select class="form-control select2" name="category_id" id="category_id" {{(isset($product))?  'readonly' : ''}}>
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($categories as $id => $category)
            <option value="{{$id}}" {{($id == @$product->category_id)? 'Selected' : ''}}>{{$category}}</option>
        @endforeach
    </select>
</div>

<!-- Brand Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.brand_id_help') }}"></i> &nbsp;{!! Form::label('brand_id', trans("product.fields.brand_id")) !!}
    <select class="form-control select2" name="brand_id" id="brand_id">
        <option selected disabled>{{trans('common.select')}}</option>
        @foreach($brands as $id => $brand)
            <option value="{{$id}}" {{($id == @$product->brand_id)? 'Selected' : ''}}>{{$brand}}</option>
        @endforeach
    </select>
</div>

<!-- Title Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('product.fields.title_en')) !!}<br/>
    {!! Form::text('title_en', null, ['class' => 'form-control']) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'title_' . $system_language;
    $input_value = (isset($product))? $product->$input_name : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.'.$input_name.'_help') }}"></i> &nbsp;{!! Form::label($input_name, trans("product.fields.$input_name")) !!}
        {!! Form::text($input_name, null, ['class' => 'form-control','minlength' => 3, 'required' => true]) !!}
    </div>
@endforeach

<!-- Price Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.price_help') }}"></i> &nbsp;{!! Form::label('price', trans('product.fields.price')) !!}
    {!! Form::number('price', null, ['class' => 'form-control','min' => 0]) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.quantity_help') }}"></i> &nbsp;{!! Form::label('quantity', trans('product.fields.quantity')) !!}
    {!! Form::number('quantity', null, ['class' => 'form-control','min' => 0]) !!}
</div>

<!-- Weight Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.weight_help') }}"></i> &nbsp;{!! Form::label('weight', trans('product.fields.weight')) !!}
    {!! Form::number('weight', null, ['class' => 'form-control','min' => 0, 'step' => 'any']) !!}
</div>

<!-- height Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.height_help') }}"></i> &nbsp;{!! Form::label('height', trans('product.fields.height')) !!}
    {!! Form::number('height', null, ['class' => 'form-control','min' => 0, 'step' => 'any']) !!}
</div>

<!-- width Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.width_help') }}"></i> &nbsp;{!! Form::label('width', trans('product.fields.width')) !!}
    {!! Form::number('width', null, ['class' => 'form-control','min' => 0, 'step' => 'any']) !!}
</div>

<!-- length Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.length_help') }}"></i> &nbsp;{!! Form::label('length', trans('product.fields.length')) !!}
    {!! Form::number('length', null, ['class' => 'form-control','min' => 0, 'step' => 'any']) !!}
</div>


<!-- Featured Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.featured_help') }}"></i> &nbsp;{!! Form::label('featured', trans("product.fields.featured")) !!}<br/>
    <label>
        <input type="hidden" name="featured" id="featured" value="0" checked>
        <input type="checkbox" name="featured" id="featured" @if(@$product->featured) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("product.fields.active")) !!}<br/>
    <label>
        <input type="hidden" name="active" id="active" value="0" checked>
        <input type="checkbox" name="active" id="active" @if(@$product->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

@if(Auth::user()->hasRole('super-admin'))
<!-- Slider Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.in_sider_help') }}"></i> &nbsp;{!! Form::label('in_slider', trans("product.fields.in_slider")) !!}<br/>
    <label>
        <input type="hidden" name="in_slider" id="in_slider" value="0" checked>
        <input type="checkbox" name="in_slider" id="in_slider" @if(@$product->in_slider) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>
@endif
<!-- Discount Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_help') }}"></i> &nbsp;{!! Form::label('discount', trans("product.fields.discount")) !!}<br/>
    <label>
        <input type="hidden" name="discount" value="0" checked>
        <input type="checkbox" name="discount" id="discount" @if(@$product->discount) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
    </label>
</div>

<div id="discount_div" hidden>
    <div class="col-sm-12">
        {{--<div id="discount_div" style="display: {{(@$product->discount) ? 'block' : 'none'}}">--}}
        <!-- Discount Rate Field -->
        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_rate_help') }}"></i> &nbsp;{!! Form::label('discount_rate', trans('product.fields.discount_rate')) !!}
            {!! Form::number('discount_rate', null, ['class' => 'form-control','placeholder'=>'%']) !!}
        </div>

        <!-- Discount Start Date Field -->
        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_start_date_help') }}"></i> &nbsp;{!! Form::label('discount_start_date', trans('product.fields.discount_start_date')) !!}
            {!! Form::date('discount_start_date', date('Y-m-d', strtotime(@$product->discount_start_date)), ['class' => 'form-control date']) !!}
        </div>

        <!-- Discount End Date Field -->
        <div class="form-group col-sm-2">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_end_date_help') }}"></i> &nbsp;{!! Form::label('discount_end_date', trans('product.fields.discount_end_date')) !!}
            {!! Form::date('discount_end_date', date('Y-m-d', strtotime(@$product->discount_end_date)), ['class' => 'form-control date']) !!}
        </div>
    </div>

</div>

<div class="col-sm-12">
    <!-- Image Field -->
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.images_help') }}"></i> &nbsp;{!! Form::label('images', trans('product.fields.images')) !!}
        <input type="file" onchange="readURL(this, 'ImagePreview', 'ImagePreview');" name="images[]" multiple id="images" @if(! isset($product)) required @endif>
    </div>
    <div class="form-group col-sm-3 ImagePreview" style="display: none">

        <label class="control-label">
            {{ trans('common.preview_button') }}
        </label>
        <br/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
    <div id="current_image" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>{{ trans('common.current_image') }}</b></h4>
                </div>
                <div class="modal-body text-center" id="data" style="display: block;">
                    <img class="ImagePreview" src="{{ asset(@$product->image) }}" style="width: 100% !important; height: 100% !important;"/>
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

<!-- Related Products Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.related_products_help') }}"></i> &nbsp;{!! Form::label('products', trans("product.fields.related_products")) !!}
    <select class="form-control select2" name="related_products[]" id="related_products" multiple>
        @foreach($products as $key => $related_products)
            <option value="{{$key}}" @if(in_array( $key , ( (!empty(@$product->relatedProducts)) ?@$product->relatedProducts->pluck("related_product_id")->toArray():[] ) )) selected @endif>{{$related_products}}</option>
        @endforeach
    </select>
</div>

<div class="col-sm-12" id="attributes" style="display: {{isset($product)? 'block' : 'none'}}">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('product.fields.category_attributes.header') }}</b></h4>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @foreach($system_languages as $i => $system_language)
        <input type="hidden" value="{{$system_language}}" name="system_language[{{$i}}]" class="system_languages">
    @endforeach
    <div class="col-sm-12 table-responsive">
        <div class="alert alert-success" style="display: none;" id="paragraphSuccess"><div id="paragraphMessage">{{ trans('common.messages.deleted') }}</div> </div>
        <table id="attributesTable" class="table-responsive table well">
            <thead>
            <tr>
                <th class="text-center"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.title_en_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.title_en') }}</b></th>
                <th class="text-center"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.description_en_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.description_en') }}</b></th>
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.active_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.active') }}</b></th>
                <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.value_en_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.value_en') }}</b></th>
                @foreach($system_languages as $system_language)
                    <th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.value_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("product.fields.category_attributes.value_$system_language") }}</b></th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @if(isset($product))
                @foreach($product->attributes as $attribute)
                    <tr>
                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $attribute->title_en }}</div></td>
                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><?php echo $attribute->description_en ?></div></td>
                        <td class="active{{$attribute->id}}">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="activeness" attribute="active" row_id="{{$attribute->id}}" @if($attribute->active) checked @endif value="1"> {{ ucfirst(trans('common.yes')) }}
                                </label>
                            </div>
                        </td>
                        <td class="value_en{{$attribute->id}}"><input type="text" class="form-control value" placeholder="{{ trans("product.fields.category_attributes.value_en") }}" value="{{$attribute->value_en}}" row_id="{{$attribute->id}}" attribute="value_en"></td>
                        @foreach($system_languages as $system_language)
                            <?php $input_name = 'value_' . $system_language; ?>
                            <td class="value_{{$system_language.$attribute->id}}"><input type="text" class="form-control value" placeholder="{{ trans("product.fields.category_attributes.value_$system_language") }}" value="{{$attribute->$input_name}}" row_id="{{$attribute->id}}" attribute="value_{{$system_language}}"></td>
                        @endforeach
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
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

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.description_en_help') }}"></i> &nbsp;{!! Form::label('description_en', trans('product.fields.description_en')) !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control','id'=>'summary-ckeditor' , 'required' => true]) !!}
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = (isset($product))? $product->$input_name : ''
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("product.fields.$input_name")) !!}
        {!! Form::textarea($input_name, null, ['class' => 'form-control','id'=>'summaryckeditor' , 'required' => true]) !!}
    </div>
@endforeach


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('products.list')
        <a href="{{ route('products.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @canany(['products.edit', 'products.create'])
    <button class="btn btn-primary col-sm-2"><i class="fa fa-save"></i> {{ trans('common.save') }}</button>
    @endcanany
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('products.delete')
        @if(isset($product))
            <a href="{{ route('products.destroy', $product->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
        @endif
    @endcan -->
</div>


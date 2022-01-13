<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.languages') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<div class="form-group col-sm-12">
    <label for="en" class="control-label">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('common.active_languages_help') }}"></i> &nbsp;{{ trans('common.active_languages') }}
    </label>

    <div class="form">
        <label>
            {{ strtoupper('en') }}
            @if($product->en)
                <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
            @else
                <i style="color: red;" class="fa fa-lg fa-times"></i>
            @endif
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @foreach($system_languages as $system_language)
            <label>
                {{ strtoupper($system_language) }}
                @if($product->$system_language)
                    <i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
                @else
                    <i style="color: red;" class="fa fa-lg fa-times"></i>
                @endif
            </label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
    </div>
</div>

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
    <?php $name = 'name_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $product->store->$name }}</div>
</div>

<!-- Category Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_id_help') }}"></i> &nbsp;{!! Form::label('category_id', trans("product.fields.category_id")) !!}
    <?php $title = 'title_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $product->category->$title }}</div>
</div>

<!-- Brand Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.brand_id_help') }}"></i> &nbsp;{!! Form::label('brand_id', trans("product.fields.brand_id")) !!}
    <?php $title = 'title_'.$language['admin'] ?>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $product->brand->$title }}</div>
</div>

<!-- Title Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('products.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('title_en', trans('product.fields.title_en')) !!}<br/>
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $product->title_en }}</div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_title = 'title_' . $system_language;
    $input_value = (isset($product))? $product->$input_title : ''
    ?>
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.'.$input_title.'_help') }}"></i> &nbsp;{!! Form::label($input_title, trans("product.fields.$input_title")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $input_value }}</div>
    </div>
@endforeach

<!-- Price Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.price_help') }}"></i> &nbsp;{!! Form::label('price', trans("product.fields.price")) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $product->price }}</div>
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.quantity_help') }}"></i> &nbsp;{!! Form::label('quantity', trans("product.fields.quantity")) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $product->quantity }}</div>
</div>

<div id="discount_div" style="display: {{($product->discount) ? 'block' : 'none'}}">
    <!-- Discount Rate Field -->
    <div class="form-group col-sm-2">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_rate_help') }}"></i> &nbsp;{!! Form::label('discount_rate', trans('product.fields.discount_rate')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $product->discount_rate }}</div>
    </div>

    <!-- Discount Start Date Field -->
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_start_date_help') }}"></i> &nbsp;{!! Form::label('discount_start_date', trans('product.fields.discount_start_date')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ date('Y-m-d',strtotime($product->discount_start_date)) }}</div>
    </div>

    <!-- Discount End Date Field -->
    <div class="form-group col-sm-3">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_end_date_help') }}"></i> &nbsp;{!! Form::label('discount_end_date', trans('product.fields.discount_end_date')) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ date('Y-m-d',strtotime($product->discount_end_date)) }}</div>
    </div>
</div>

<div class="col-sm-12">
    <br/>
</div>

<!-- Discount Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.discount_help') }}"></i> &nbsp;{!! Form::label('discount', trans("product.fields.discount")) !!}
    <h4>
        @if($product->discount)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Featured Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.featured_help') }}"></i> &nbsp;{!! Form::label('featured', trans("product.fields.featured")) !!}
    <h4>
        @if($product->featured)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Active Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.active_help') }}"></i> &nbsp;{!! Form::label('active', trans("product.fields.active")) !!}
    <h4>
        @if($product->active)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Image Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.image_help') }}"></i> &nbsp;{!! Form::label('image', trans('product.fields.image')) !!}
    <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#current_image"><i class="glyphicon glyphicon-eye-open"></i></button>
    </div>
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
                <img class="ImagePreview" src="{{ asset($product->image) }}" style="width: 100% !important; height: 100% !important;"/>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="cancel" style="display: block;">{{ trans('common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('product.fields.category_attributes.header') }}</b></h4>
    </div>
    <div class="col-sm-12 table-responsive">
        <table class="table-responsive table">
            <thead>
            <tr>
                <th class="text-center"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.title_en_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.title_en') }}</b></th>
                <th class="text-center"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.description_en_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.description_en') }}</b></th>
                <th class="text-center"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.active_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.active') }}</b></th>
                <th class="text-center"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.value_en_help') }}"></i> &nbsp;{{ trans('product.fields.category_attributes.value_en') }}</b></th>
                @foreach($system_languages as $system_language)
                    <th class="text-center"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.category_attributes.value_'.$system_language.'_help') }}"></i> &nbsp;{{ trans("product.fields.category_attributes.value_$system_language") }}</b></th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @if(isset($product))
                @foreach($product->attributes as $attribute)
                    <tr>
                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $attribute->title_en }}</div></td>
                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div><?php echo $attribute->description_en ?></div></td>
                        <td>
                            <div class="field_show text-center">
                            @if($attribute->active)
                                <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
                            @else
                                <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
                            @endif
                            </div>
                        </td>
                        <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $attribute->value_en }}</div></td>
                        @foreach($system_languages as $system_language)
                            <?php $input_name = 'value_' . $system_language; ?>
                            <td><div class="field_show text-center"><div class="col-sm-1">&nbsp;</div>{{ $attribute->$input_name }}</div></td>
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
    <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $product->description_en ?></div>
</div>
@foreach($system_languages as $system_language)
    <?php
    $input_name = 'description_' . $system_language;
    $input_value = $product->$input_name;
    ?>
    <div class="form-group col-sm-6 col-lg-6">
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('product.fields.'.$input_name.'_help') }}"></i> &nbsp; {!! Form::label($input_name, trans("product.fields.$input_name")) !!}
        <div class="field_show"><div class="col-sm-1">&nbsp;</div><?php echo $input_value ?></div>
    </div>
@endforeach

<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('products.list')
        <a href="{{ route('products.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('products.edit')
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('products.delete')
        <a href="{{ route('products.destroy', $product->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>


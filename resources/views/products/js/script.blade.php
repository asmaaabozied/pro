<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-Token': '<?php echo csrf_token() ?>'}
    });

    $(document).on('click', '#discount', function(){
        if($('#discount').prop('checked') == true) {
            $("#discount_div").show();
        } else {
            $("#discount_div").hide();
        }
    });

    $("#category_id").bind('change', function()
    {
        $(".attributesRow").remove();
        var id = $(this).val();
        var getAttributesURL = '<?php echo route('products.ajax.category-attributes.fetch') ?>';
        $.ajax({
            type: "POST",
            url: getAttributesURL,
            dataType: 'JSON',
            data: {category_id : id},
            success: function(data)
            {
                $('#attributes').show();
                $.each(data, function (key, element) {
                    var tr = '<tr class="attributesRow">';
                    tr += '<td><div class="text-center"><div class="col-sm-1">&nbsp;</div>'+element["title"]+'</div></td>';
                    tr += '<td><div class="text-center"><div class="col-sm-1">&nbsp;</div>'+element["description"]+'</div></td>';
                    tr += '<td class="active' + element["id"] + '"><input row_id="' + element["id"] + '" attribute="active" type="checkbox" value="1" name="active' + key + '"></td>';
                    tr += '<td class="value_en' + element["id"] + '"><input row_id="' + element["id"] + '" attribute="value_en" type="text" class="form-control" placeholder="{{ trans('product.fields.category_attributes.value_en') }}" name="value_en' + key + '"></td>';
                    $('input.system_languages').each(function() {
                        <?php $iterator = 0; ?>
                        tr += '<td class="value_' + $(this).val() + element["id"] + '"><input row_id="' + element["id"] + '" attribute="value_'+ $(this).val()+'" type="text" class="form-control" placeholder="{{ trans('product.fields.category_attributes.value_en') }}" name="value_' + $(this).val() + key + '"></td>';
                    });
                    tr += '</tr>';
                    $('#attributesTable tr:last').after(tr);
                });
            }
        });
    });

    $(document).on('click', '.imageActive', function(){
        var id = $(this).attr('row_id');
        var updateURL = '<?php echo route('products.ajax.images.editProductImageActive') ?>';
        $.ajax({
            type: "POST",
            url: updateURL,
            dataType: 'JSON',
            data: {id : id, value: $(this).prop('checked')},
            success: function(data)
            {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });

    $(document).on('click', '.main', function(){
        var id = $(this).attr('row_id');
        var updateURL = '<?php echo route('products.ajax.images.editProductImageMain') ?>';
        $.ajax({
            type: "POST",
            url: updateURL,
            dataType: 'JSON',
            data: {id : id, value: $(this).prop('checked')},
            success: function(data)
            {
                $('.main' + id).addClass('alert alert-success');
                $.each(data, function (key, element) {
                    $('#main' + element).prop('checked', false);
                    $('.main' + element).addClass('alert alert-success');
                });
            }
        });
    });

    $(document).on('click', '.deleteImage', function(){
        var id = $(this).val();
        var deleteUrl = '<?php echo route('products.ajax.images.deleteProductImage') ?>';
        $.ajax({
            type: "POST",
            url: deleteUrl,
            dataType: 'JSON',
            data: {id : id},
            success: function(data)
            {
                $('#deleteSuccess').show();
                $('.image'+id).remove();
                if(data != true){
                    $('#main' + data).prop('checked', true);
                    $('.main' + data).addClass('alert alert-success');
                }
            }
        });
    });

    $(document).on('click', '.unlinkRelatedProduct', function(){
        var id = $(this).val();
        var unlinkUrl = '<?php echo route('products.ajax.related-products.unlinkRelatedProduct') ?>';
        $.ajax({
            type: "POST",
            url: unlinkUrl,
            dataType: 'JSON',
            data: {id : id},
            success: function(data)
            {
                $('#relatedProductUnlinkSuccess').show();
                $('.relatedProduct'+id).remove();
            }
        });
    });

    $(document).on('click', '.activeness', function(){
        var id = $(this).attr('row_id');
        var updateURL = '<?php echo route('products.ajax.category-attributes.editProductAttributeActive') ?>';
        $.ajax({
            type: "POST",
            url: updateURL,
            dataType: 'JSON',
            data: {id : id, value: $(this).prop('checked')},
            success: function(data)
            {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });

    $(document).on('blur', '.value', function(){
        var id = $(this).attr('row_id');
        var updateURL = '<?php echo route('products.ajax.category-attributes.editProductAttributeValue') ?>';
        $.ajax({
            type: "POST",
            url: updateURL,
            dataType: 'JSON',
            data: {id : id, value: $(this).val(), name: $(this).attr('attribute')},
            success: function(data)
            {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });
</script>
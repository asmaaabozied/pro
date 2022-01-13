<script type="text/javascript">

    $.ajaxSetup({
        headers: {'X-CSRF-Token': '<?php echo csrf_token() ?>'}
    });

    $(document).on('ready', function () {
        $(document).on('click', '.subscription', function(){
            var id = $(this).val();
            var url = '<?php echo route('storeSubscriptions.ajax.getSubscriptionPrice') ?>';
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'JSON',
                data: {id : id},
                success: function(data)
                {
                    $('#price').val(data);
                }
            });
        });
    });
    $(document).on('click', '.removeCartItem', function(){
        var id = $(this).val();
        var cart_id = $('#cart_id').val();
        var deleteUrl = '<?php echo route('carts.ajax.cartItems.removeItem') ?>';
        $.ajax({
            type: "POST",
            url: deleteUrl,
            dataType: 'JSON',
            data: {id : id, cart_id: cart_id},
            success: function(data)
            {
                $('#deleteSuccess').show();
                $('.cartItem' + id).remove();
                $('#cartItemsTotal').html(data);
            }
        });
    });

    $(document).on('click', '#discount_type', function(){
        if($(this).val() == 'coupon'){
            $('#coupon').show();
            $('#offer').hide();
        }
    });
</script>
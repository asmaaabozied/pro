<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-Token': '<?php echo csrf_token() ?>'}
    });

    $(document).on('click', '.deleteImage', function(){
        var id = $(this).val();
        var deleteUrl = '<?php echo route('coupons.ajax.images.deleteCouponImage') ?>';
        $.ajax({
            type: "POST",
            url: deleteUrl,
            dataType: 'JSON',
            data: {id : id},
            success: function(data)
            {
                $('#deleteSuccess').show();
                $('.image'+id).remove();
            }
        });
    });
</script>
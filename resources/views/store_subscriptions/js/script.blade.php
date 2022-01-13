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
</script>
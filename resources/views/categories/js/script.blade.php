<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-Token': '<?php echo csrf_token() ?>'}
    });

    $(document).on('click', '#menu', function(){
        if($('#menu').prop('checked') == true) {
            $("#order_div").show();
        } else {
            $("#order_div").hide();
        }
    });
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-Token': '<?php echo csrf_token() ?>'}
    });

    $(document).on('click', '#general', function(){
        if($('#general').prop('checked') == false) {
            $("#type_div").show();
        } else {
            $("#type_div").hide();
            $("#filter_type_div").hide();
            $("#country_div").hide();
            $("#city_div").hide();
            $("#users_div").hide();
            $("#subscription_div").hide();
            $("select").each(function() { this.selectedIndex = 0 });
            emptyCities();
        }
    });

    $(document).on('change', '#type', function(){
        if($(this).val() == 'custom') {
            $("#filter_type_div").show();
        } else {
            $("#filter_type_div").hide();
            $("#country_div").hide();
            $("#city_div").hide();
            $("#users_div").hide();
            $("#subscription_div").hide();
            $(".filter").each(function() { this.selectedIndex = 0 });
            emptyCities();
        }
    });

    $(document).on('change', '#filter_type', function(){
        if($(this).val() == 'regions') {
            $("#country_div").show();
            $("#city_div").show();
        } else {
            $("#country_div").hide();
            $("#city_div").hide();
            $(".filter").each(function() { this.selectedIndex = 0 });
            emptyCities();
        }
    });

    $(document).on('change', '#filter_type', function(){
        if($(this).val() == 'users') {
            $("#users_div").show();
        } else {
            $("#users_div").hide();
            $(".filter").each(function() { this.selectedIndex = 0 });
        }
    });

    $(document).on('change', '#filter_type', function(){
        if($(this).val() == 'subscriptions') {
            $("#subscription_div").show();
        } else {
            $("#subscription_div").hide();
            $(".filter").each(function() { this.selectedIndex = 0 });
        }
    });

    $(document).ready(function(){
        $("#country").on('change', function () {
            var url = "{{route('ajax.fetch-country-cities')}}";
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'JSON',
                data: {country_id: $(this).val()},
                success: function (data)
                {
                    var cities = $("#cities");
                    cities.empty(); // remove old options
                    if (data != '') {
                        cities.append($("<option></option>")
                                .attr("value", 0).text("{{trans('city.all')}}"));
                    }
                    $.each(data, function(value,key) {
                        cities.append($("<option></option>")
                                .attr("value", value).text(key));
                    });
                }
            });
        });
    });

    function emptyCities() {
        var cities = $("#cities");
        cities.empty(); // remove old options
        cities.append($("<option></option>")
                .attr("disabled", true)
                .text("{{trans('common.select')}}"));
    }
</script>
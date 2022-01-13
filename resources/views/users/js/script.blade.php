<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });

    $(document).ready(function(){
        $("#country_id").on('change', function () {
            var url = "{{route('ajax.fetch-country-cities')}}";
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'JSON',
                data: {country_id: $(this).val()},
                success: function (data)
                {
                    var cities = $("#city_id");
                    cities.empty(); // remove old options
                    $.each(data, function(value,key) {
                        cities.append($("<option></option>")
                                .attr("value", value).text(key));
                    });
                }
            });
        });
    });
</script>
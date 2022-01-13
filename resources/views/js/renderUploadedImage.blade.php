<script type="text/javascript">
    function readURL(input, button_class_name, image_class_name) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.'+image_class_name)
                    .attr('src', e.target.result)
                    .attr('width', '150')
            };
            reader.readAsDataURL(input.files[0]);
        }
        else {
            var img = input.value;
            $('.'+image_class_name)
                    .attr('src',img)
                    .attr('width', '150');
        }
        $('.'+button_class_name).show();
    }
</script>
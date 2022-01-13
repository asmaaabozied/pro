<script type="text/javascript">

    $.ajaxSetup({
        headers: {'X-CSRF-Token': '<?php echo csrf_token() ?>'}
    });

    $(".addParagraph").bind('click', function()
    {
        var slug = $('#slug').val();
        var addParagraphURL = '<?php echo route('aboutuses.ajax.addParagraph') ?>';
        $.ajax({
            type: "POST",
            url: addParagraphURL,
            dataType: 'JSON',
            data: {slug : slug},
            success: function(data)
            {
                var tr = '<tr class="row0' + data + '">';
                tr += '<th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.title_en') }}</b></th>';
                $('input.system_languages').each(function() {
                    tr += '<th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.title_ar_help') }}"></i> &nbsp;{{ trans('aboutus.fields.title_ar') }}</b></th>';
                });
                tr += '<th><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.active_help') }}"></i> &nbsp;{{ trans('aboutus.fields.active') }}</b></th>';
                tr += '<th><b>{{ trans('common.delete') }}</b></th>';
                tr += '</tr>';
                $('#addParagraphTable tr:last').after(tr);

                var tr = '<tr class="row1' + data + '">';
                tr += '<td class="title_en' + data + '"><input row_id="' + data + '" attribute="title_en" type="text" class="form-control title" placeholder="{{ trans('store.fields.terms_and_policy.title_en') }}"></td>';
                $('input.system_languages').each(function() {
                    tr += '<td class="title_' + $(this).val() + '' + data + '"><input  row_id="' + data + '" attribute="title_' + $(this).val() + '" type="text" class="form-control title" placeholder="{{ trans('store.fields.terms_and_policy.title_en') }}"></td>';
                });
                tr += '<td class="active' + data + '"><input row_id="' + data + '" attribute="active" class="activeness" type="checkbox" value="1"></td>';
                tr += '<td><button type="button" class="btn btn-sm btn-danger deleteParagraph" value="' + data + '"><i class="fa fa-remove"></i> </button></td>';
                tr += '</tr>';
                $('#addParagraphTable tr:last').after(tr);

                var tr = '<tr class="row2' + data + '">';
                tr += '<th colspan="2"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_en_help') }}"></i> &nbsp;{{ trans('aboutus.fields.description_en') }}</b></th>';
                $('input.system_languages').each(function() {
                    tr += '<th colspan="2"><b><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('aboutus.fields.description_ar_help') }}"></i> &nbsp;{{ trans("aboutus.fields.description_ar") }}</b></th>';
                });
                tr += '</tr>';
                $('#addParagraphTable tr:last').after(tr);

                var tr = '<tr class="row3' + data + '">';
                tr += '<td colspan="2" class="description_en' + data + '"><textarea row_id="' + data + '" attribute="description_en" class="form-control description" placeholder="{{ trans('store.fields.terms_and_policy.description_en') }}"></textarea></td>';
                $('input.system_languages').each(function() {

                    tr += '<td colspan="2" class="description_' + $(this).val() + '' + data + '"><textarea row_id="' + data + '" attribute="description_' + $(this).val() + '" class="form-control description" placeholder="{{ trans('store.fields.terms_and_policy.description_en') }}"></textarea></td>';
                });
                tr += '</tr><tr class="row4' + data + '"><td colspan="4" style="background: #3c8dbcab"></td></tr>';
                $('#addParagraphTable tr:last').after(tr);
            }
        });
    });
    $(document).on('blur', '.title', function(){
        var id = $(this).attr('row_id');
        var attribute = $(this).attr('attribute');
        var editTitleUrl = '<?php echo route('aboutuses.ajax.editParagraphTitle') ?>';
        $.ajax({
            type: "POST",
            url: editTitleUrl,
            dataType: 'JSON',
            data: {id : id, value: $(this).val(), name: $(this).attr('attribute')},
            success: function(data)
            {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });
    $(document).on('blur', '.description', function(){
        var id = $(this).attr('row_id');
        var editDescriptionUrl = '<?php echo route('aboutuses.ajax.editParagraphDescription') ?>';
        $.ajax({
            type: "POST",
            url: editDescriptionUrl,
            dataType: 'JSON',
            data: {id : id, value: $(this).val(), name: $(this).attr('attribute')},
            success: function(data)
            {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });
    $(document).on('click', '.activeness', function(){
        var id = $(this).attr('row_id');
        var editActiveUrl = '<?php echo route('aboutuses.ajax.editParagraphActive') ?>';
        $.ajax({
            type: "POST",
            url: editActiveUrl,
            dataType: 'JSON',
            data: {id : id, value: $(this).prop('checked')},
            success: function(data)
            {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });

    $(document).on('blur', '.image', function(){
        var id = $(this).attr('row_id');
        var imageUrl = '<?php echo route('aboutuses.ajax.editImageParagraph') ?>';
        $.ajax({
            type: "POST",
            url: imageUrl,
            data: {id : id, value: new FormData($('#devis')[0])},
            processData: false,
            contentType: false,
            success: function (data) {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });

    $(document).on('click', '.deleteParagraph', function(){
        var id = $(this).val();
        var deleteUrl = '<?php echo route('aboutuses.ajax.deleteParagraph') ?>';
        $.ajax({
            type: "POST",
            url: deleteUrl,
            dataType: 'JSON',
            data: {id : id},
            success: function(data)
            {
                if(data == true){
                    $('#paragraphSuccess').show();
                    $('.row0' + id).remove();
                    $('.row1' + id).remove();
                    $('.row2' + id).remove();
                    $('.row3' + id).remove();
                    $('.row4' + id).remove();
                }
            }
        });
    });
</script>

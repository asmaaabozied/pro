<script type="text/javascript">

    $.ajaxSetup({
        headers: {'X-CSRF-Token': '<?php echo csrf_token() ?>'}
    });

    $(document).on('ready', function () {
        if ($('#counter').val() > 0)
        {
            var counter = $('#counter').val();
            for (iterator = 1; iterator <= counter; iterator++)
            {
                $('.deleteParagraphRow').hide();
                $('#addParagraphTable tr:last').after(drawNewParagraphRaw(iterator));
            }
        }
    });

    function drawNewParagraphRaw(counter) {
        var tr = '<tr class="' + counter + '">';
        tr += '<td><input type="text" class="form-control" placeholder="{{ trans('store.fields.terms_and_policy.title_en') }}" value="{{ request()->input('paragraph_title_en'.\Illuminate\Support\Facades\Config::get('paragraph_counter')) }}" required name="paragraph_title_en' + counter + '"></td>';
        $('input.system_languages').each(function() {
            <?php $iterator = 0; ?>
                    tr += '<td><input type="text" class="form-control" placeholder="{{ trans('store.fields.terms_and_policy.title_en') }}" value="{{ request()->input('paragraph_title_'.\Illuminate\Support\Facades\Config::get('system_languages')[$iterator++].\Illuminate\Support\Facades\Config::get('paragraph_counter')) }}" required name="paragraph_title_' + $(this).val() + counter + '"></td>';
        });
        tr += '<td><textarea class="form-control" placeholder="{{ trans('store.fields.terms_and_policy.description_en') }}" value="{{ request()->input('paragraph_description_en'.\Illuminate\Support\Facades\Config::get('paragraph_counter')) }}" required name="paragraph_description_en' + counter + '"></textarea></td>';
        $('input.system_languages').each(function() {
            <?php $iterator = 0; ?>
                    tr += '<td><textarea class="form-control" placeholder="{{ trans('store.fields.terms_and_policy.description_en') }}" value="{{ request()->input('paragraph_description_'.\Illuminate\Support\Facades\Config::get('system_languages')[$iterator++].\Illuminate\Support\Facades\Config::get('paragraph_counter')) }}" required name="paragraph_description_' + $(this).val() + counter + '"></textarea></td>';
        });
        tr += '<td><input type="hidden" name="paragraph_active' + counter + '" value="0" checked><input type="checkbox" name="paragraph_active' + counter + '" value="1">{{ trans('common.yes') }}</td>';
        tr += '<td>' +
                '<input type="hidden" name="paragraph_en' + counter + '" value="0" checked><input type="checkbox" name="paragraph_en' + counter + '" value="1">' + 'en'.toUpperCase();
        $('input.system_languages').each(function() {
            tr += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="paragraph_' + $(this).val() + counter + '" value="0" checked>' +
                    '<input type="checkbox" name="paragraph_' + $(this).val() + counter + '" value="1">' + $(this).val().toUpperCase();
        });
        tr += '</td>';
        tr += '<td><button type="button" class="btn btn-xs btn-danger deleteParagraphRow deleteParagraphRow' + counter + '" value="' + counter + '"><i class="fa fa-remove"></i> </button></td>';
        tr += '</tr>';
        return tr;
    }

    $(".addNewParagraph").bind('click', function()
    {
        $('.deleteParagraphRow').hide();
        var counter = parseInt($('#counter').val()) + 1;
        $('#addParagraphTable tr:last').after(drawNewParagraphRaw(counter));
        $('#counter').val(counter);
    });

    $(".addParagraph").bind('click', function()
    {
        var id = $(this).val();
        var addParagraphURL = '<?php echo route('stores.ajax.termsAndPolicy.addParagraph') ?>';
        $.ajax({
            type: "POST",
            url: addParagraphURL,
            dataType: 'JSON',
            data: {id : id},
            success: function(data)
            {
                var tr = '<tr class="' + data + '">';
                tr += '<td class="title_en' + data + '"><input row_id="' + data + '" attribute="title_en" type="text" class="form-control title" placeholder="{{ trans('store.fields.terms_and_policy.title_en') }}"></td>';
                $('input.system_languages').each(function() {
                    tr += '<td class="title_' + $(this).val() + '' + data + '"><input  row_id="' + data + '" attribute="title_' + $(this).val() + '" type="text" class="form-control title" placeholder="{{ trans('store.fields.terms_and_policy.title_en') }}"></td>';
                });
                tr += '<td class="description_en' + data + '"><textarea row_id="' + data + '" attribute="description_en" class="form-control description" placeholder="{{ trans('store.fields.terms_and_policy.description_en') }}"></textarea></td>';
                $('input.system_languages').each(function() {
                    tr += '<td class="description_' + $(this).val() + '' + data + '"><textarea row_id="' + data + '" attribute="description_' + $(this).val() + '" class="form-control description" placeholder="{{ trans('store.fields.terms_and_policy.description_en') }}"></textarea></td>';
                });
                tr += '<td class="active' + data + '"><input row_id="' + data + '" attribute="active" class="activeness" type="checkbox" value="1"></td>';
                tr += '<td class="language' + data + '">' +
                        '<input row_id="' + data + '" attribute="en" class="language" type="checkbox" value="1">' + 'en'.toUpperCase();
                $('input.system_languages').each(function() {
                    tr += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<input row_id="' + data + '" attribute="' + $(this).val() + '" class="language" type="checkbox" value="1">' + $(this).val().toUpperCase();
                });
                tr += '<td><button type="button" class="btn btn-xs btn-danger deleteParagraph" value="' + data + '"><i class="fa fa-remove"></i> </button></td>';
                tr += '</tr>';
                $('#addParagraphTable tr:last').after(tr);
                $('.' + data).addClass('alert alert-success');
            }
        });
    });
    $(document).on('blur', '.title', function(){
        var id = $(this).attr('row_id');
        var attribute = $(this).attr('attribute');
        var editTitleUrl = '<?php echo route('stores.ajax.termsAndPolicy.editParagraphTitle') ?>';
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
        var editDescriptionUrl = '<?php echo route('stores.ajax.termsAndPolicy.editParagraphDescription') ?>';
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
        var editActiveUrl = '<?php echo route('stores.ajax.termsAndPolicy.editParagraphActive') ?>';
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
    $(document).on('click', '.language', function(){
        var id = $(this).attr('row_id');
        var editActiveUrl = '<?php echo route('stores.ajax.termsAndPolicy.editParagraphLanguage') ?>';
        $.ajax({
            type: "POST",
            url: editActiveUrl,
            dataType: 'JSON',
            data: {id : id, value: $(this).prop('checked'), name: $(this).attr('attribute')},
            success: function(data)
            {
                $('.' + data).addClass('alert alert-success');
            }
        });
    });
    $(document).on('click', '.deleteParagraph', function(){
        var id = $(this).val();
        var deleteUrl = '<?php echo route('stores.ajax.termsAndPolicy.deleteParagraph') ?>';
        $.ajax({
            type: "POST",
            url: deleteUrl,
            dataType: 'JSON',
            data: {id : id},
            success: function(data)
            {
                $('#paragraphSuccess').show();
                $('.' + id).remove();
            }
        });
    });
    $(document).on('click', '.deleteParagraphRow', function(){
        var id = $(this).val();
        $('.' + id).remove();
        $('#counter').val(parseInt($('#counter').val()) - 1);
        $('.deleteParagraphRow' + $('#counter').val()).show();
    });
</script>
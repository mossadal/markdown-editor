var files;



$(window).load(function () {
    $('.md-button-bold').click(function() {
        var textarea = $(this).parent().nextAll('.md-preview-source').first();
        s = textarea.textrange();

        if (s.length == 0) s.text = replace_text['bold'];

        replacement = '**' + s.text + '**';

        textarea.textrange('replace', replacement)
                .textrange('set', s.start+2, replacement.length-4 )
                .trigger('input');

    });

    $('.md-button-italic').click(function() {
        var textarea = $(this).parent().nextAll('.md-preview-source').first();
        s = textarea.textrange();

        if (s.length == 0) s.text = replace_text['italic'];

        replacement = '*' + s.text + '*';
        textarea.textrange('replace', replacement)
                .textrange('set', s.start+1, replacement.length-2 )
                .trigger('input');
    });

    $('.md-button-blockquote').click(function() {
        var textarea = $(this).parent().nextAll('.md-preview-source').first();
        s = textarea.textrange();

        if (s.length == 0) s.text = replace_text['quote'];

        replacement = '\n> ' + s.text;
        textarea.textrange('replace', replacement)
                .textrange('set', s.start+3, replacement.length-3 )
                .trigger('input');
    });

    $('.md-button-url').click(function() {
        var textarea = $(this).parent().nextAll('.md-preview-source').first();
        s = textarea.textrange();

        if (s.length == 0) s.text = replace_text['url'];

        replacement = '[' + replace_text['img_description'] + '](' + s.text + ')';
        $textarea.textrange('replace', replacement)
                .textrange('set', s.start+1, replace_text['img_description'].length )
                .trigger('input');

    });

    $('.md-button-img').click(function() {
        var textarea = $(this).parent().nextAll('.md-preview-source').first();
        s = textarea.textrange();

        if (s.length == 0) s.text = replace_text['url'];

        replacement = '![' + replace_text['img_description'] + '](' + s.text + ')';
        textarea.textrange('replace', replacement)
                .textrange('set', s.start+2, replace_text['img_description'].length )
                .trigger('input');
    });

    form_html = [
        '<div id="md-editor-upload-form">',
        '<h3>' + replace_text['upload_header'] + '</h3>',
        '<form id="md-editor-upload-form-form" name="md-editor-upload-form-form" method="post" enctype="multipart/form-data">',
        '<div class="md-editor-upload-form-browse">',
        replace_text['upload'],
        '</div>',
        '<input type="file" name="fileToUpload" id="fileToUpload" required>',
        '<input class="qa-form-tall-button qa-form-tall-button-save" id="md-editor-upload-submit" type="submit" value="Upload Image">',
        '<input class="qa-form-tall-button qa-form-tall-button-cancel" id="md-editor-upload-cancel" title="" value="' + replace_text['cancel'] + '" name="docancel">',
        '</form>',
        '</div>',
    ].join('\n');

    $('.qa-main').after(form_html);

    // Add events
    $('input[type=file]').on('change', prepareUpload);

    // Grab the files and set them to our variable
    function prepareUpload(event)
    {
      files = event.target.files;
    }

    $('.md-button-upload').click(function() {
        var textarea = $(this).parent().nextAll('.md-preview-source').first();

        $('#md-editor-upload-form').show();
        $('#md-editor-upload-cancel').click(function () {
            $('#md-editor-upload-form').hide();
        });
        $('#md-editor-upload-form').submit(function (event) {

            var s = textarea.textrange();

            event.stopPropagation();
            event.preventDefault();

            var data = new FormData();
            $.each(files, function(key, value) {
                data.append(key, value);
            })

            $.ajax({
                url: local_upload_url,
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR)
                {
                    $('#md-editor-upload-form').hide();

                    if (data.url === null) {
                        alert(data.message);
                    } else {
                        if (s.length == 0) s.text = replace_text['img_description'];

                        replacement = '![' + s.text + '](' + data.url + ')';
                        textarea.textrange('replace', replacement)
                                .textrange('set', s.start+2, s.text.length )
                                .trigger('input');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus);
                }
            });
        });

    });
});

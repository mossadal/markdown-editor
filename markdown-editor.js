var files;



$(window).load(function () {
    $('.md-button-bold').click(function() {
        s = $('textarea.md-preview-source').textrange();

        // console.log('selection = ' + JSON.stringify(s));
        if (s.length == 0) s.text = replace_text['bold'];

        replacement = '**' + s.text + '**';
        $('textarea.md-preview-source')
            .textrange('replace', replacement)
            .textrange('set', s.start+2, replacement.length-4 );
    });

    $('.md-button-italic').click(function() {
        s = $('textarea.md-preview-source').textrange();

        // console.log('selection = ' + JSON.stringify(s));
        if (s.length == 0) s.text = replace_text['italic'];

        replacement = '*' + s.text + '*';
        $('textarea.md-preview-source')
            .textrange('replace', replacement)
            .textrange('set', s.start+1, replacement.length-2 );
    });

    $('.md-button-blockquote').click(function() {
        s = $('textarea.md-preview-source').textrange();

        // console.log('selection = ' + JSON.stringify(s));
        if (s.length == 0) s.text = replace_text['quote'];

        replacement = '\n> ' + s.text;
        $('textarea.md-preview-source')
            .textrange('replace', replacement)
            .textrange('set', s.start+3, replacement.length-3 );
    });

    $('.md-button-url').click(function() {
        s = $('textarea.md-preview-source').textrange();

        // console.log('selection = ' + JSON.stringify(s));
        if (s.length == 0) s.text = replace_text['url'];

        replacement = '[' + replace_text['img_description'] + '](' + s.text + ')';
        $('textarea.md-preview-source')
            .textrange('replace', replacement)
            .textrange('set', s.start+1, replace_text['img_description'].length );

    });

    $('.md-button-img').click(function() {
        s = $('textarea.md-preview-source').textrange();

        // console.log('selection = ' + JSON.stringify(s));
        if (s.length == 0) s.text = replace_text['url'];

        replacement = '![' + replace_text['img_description'] + '](' + s.text + ')';
        $('textarea.md-preview-source')
            .textrange('replace', replacement)
            .textrange('set', s.start+2, replace_text['img_description'].length );
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
      console.log(files);
    }

    $('.md-button-upload').click(function() {
        $('#md-editor-upload-form').show();
        $('#md-editor-upload-cancel').click(function () {
            $('#md-editor-upload-form').hide();
        });
        $('#md-editor-upload-form').submit(function (event) {
            event.stopPropagation();
            event.preventDefault();

            var data = new FormData();
            $.each(files, function(key, value) {
                data.append(key, value);
                // console.log('Adding ' + key + ':' +  value);
            })

            // console.log('data:'+JSON.stringify(data));

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
                    console.log(JSON.stringify(data));
                    $('textarea.md-preview-source')
                        .selection('insert', { text: '![', mode: 'before' })
                        .selection('insert', { text: ']('+data.url+')\n', mode: 'after' })
                        .selection('replace', { text: replace_text['img_description'] })
                        .trigger('input');
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus);
                }
            });
        });

    });
});

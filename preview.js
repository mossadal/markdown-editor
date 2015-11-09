var local_ajax_url;
var local_upload_url;

function mathjaxPreview(id)
{
    el = document.getElementById(id);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, el ]);
}

function updatePreview(id)
{
    var chunk = id.val();
    var mathjax_timeout;

    $.ajax({
        url: local_ajax_url,
        type: 'GET',
        data: { 'text': chunk },
        cache: false,
        dataType: 'json',
        success: function(data, textStatus, jqXHR)
        {
            var preview = id.parent().find('.md-preview');
            preview.html(data.html);
            clearTimeout(mathjax_timeout);
            mathjax_timeout = setTimeout(function () { mathjaxPreview(preview.id) }, 1000);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        }
    });
}

var previewTimeout = {};

function setupPreview(ajax_url, upload_url)
{
    local_ajax_url = ajax_url;
    local_upload_url = upload_url;

    previewTimeout = {};

    $('.md-preview-source').each(function (index, value) {
        $(this).on("input", function (event) {
            var element = $(this);
            if (index in previewTimeout) clearTimeout(previewTimeout[index]);
            previewTimeout[index] = setTimeout(function () {
                updatePreview(element);
            }, 500)
        });
    });
}

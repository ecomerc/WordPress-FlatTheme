jQuery(function($){
    $('.custom_media_upload').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Title',
            button: {
                text: 'Custom Button Text',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.custom_media_image').attr('src', attachment.url);
            $('.custom_media_url').val(attachment.url);
            $('.custom_media_id').val(attachment.id);
        })
        .open();
    });    

    $('.custom_media_upload2').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Title',
            button: {
                text: 'Custom Button Text',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.custom_media_image2').attr('src', attachment.url);
            $('.custom_media_url2').val(attachment.url);
            $('.custom_media_id2').val(attachment.id);
        })
        .open();
    });
});
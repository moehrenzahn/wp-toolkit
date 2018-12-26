function initMediaSelector(
    currentValue,
    buttonId,
    inputId,
    removeButtonId
) {
    // Uploading files
    var fileFrame;
    var mediaId = wp.media.model.settings.post.id;
    var currentMediaId = currentValue;
    jQuery('#' + removeButtonId).on('click', function (event) {
        event.preventDefault();
        jQuery('#' + buttonId).attr('src', '');
        jQuery('#' + inputId).val('');
    });
    jQuery('#' + buttonId).on('click', function (event) {
        event.preventDefault();
        // If the media frame already exists, reopen it.
        if (fileFrame) {
            // Set the post ID to what we want
            fileFrame.uploader.uploader.param('post_id', currentMediaId);
            // Open frame
            fileFrame.open();
            return;
        } else {
            // Set the wp.media post id so the uploader grabs the ID we want when initialised
            wp.media.model.settings.post.id = currentMediaId;
        }
        // Create the media frame.
        fileFrame = wp.media.frames.fileFrame = wp.media({
            multiple: false	// Set to true to allow multiple files to be selected
        });
        // When an image is selected, run a callback.
        fileFrame.on('select', function () {
            // We set multiple to false so only get one image from the uploader
            attachment = fileFrame.state().get('selection').first().toJSON();
            // Do something with attachment.id and/or attachment.url here
            jQuery('#' + buttonId).attr('src', attachment.url);
            jQuery('#' + inputId).val(attachment.id);
            // Restore the main post ID
            wp.media.model.settings.post.id = mediaId;
        });
        // Finally, open the modal
        fileFrame.open();
    });
    // Restore the main ID when the add media button is pressed
    jQuery('a.add_media').on('click', function () {
        wp.media.model.settings.post.id = mediaId;
    });
}
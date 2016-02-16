<?php

function kad_gallery_field( $field, $meta ) {
    echo '<div class="kad-gallery kad_widget_image_gallery">';
    echo '<div class="gallery_images">';
    $attachments = array_filter( explode( ',', $meta ) );
             if ( $attachments )
            foreach ( $attachments as $attachment_id ) {
                $img = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                $imgfull = wp_get_attachment_image_src($attachment_id, 'full');
                    echo '<a class="of-uploaded-image" target="_blank" rel="external" href="' . $imgfull[0] . '">';
                    echo '<img class="gallery-widget-image" id="gallery_widget_image_'.$attachment_id. '" src="' . $img[0] . '" />';
                    echo '</a>';
                }
    echo '</div>';
    echo ' <input type="hidden" id="' . $field['id'] . '" name="' . $field['id'] . '" class="gallery_values" value="' . $meta . '" />';
    echo '<a href="#" onclick="return false;" id="edit-gallery" class="gallery-attachments button button-primary">' . __('Add/Edit Gallery', 'pinnacle') . '</a>';
    echo '<a href="#" onclick="return false;" id="clear-gallery" class="gallery-attachments button">' . __('Clear Gallery', 'pinnacle') . '</a>';
    echo '</div>';

    if ( ! empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';
}
add_filter( 'cmb_render_kad_gallery', 'kad_gallery_field', 10, 2 );

function kad_gallery_field_sanitise( $field, $meta ) {
    if ( empty( $meta ) ) {
        $meta = '';
    } else {
        $meta = $meta;
    }

    return $meta;
}

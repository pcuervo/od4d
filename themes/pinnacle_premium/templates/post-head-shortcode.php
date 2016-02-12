<?php
/**
 * Template for displaying shortcode in posts head area.
 */
global $post;
?>
<section class="postfeat post_shortcode_outerrim">
    <?php if ( has_post_format( 'video' )) {
        $post_shortcode = get_post_meta( $post->ID, '_kad_post_video_shortcode', true ); 
        echo do_shortcode($post_shortcode);
    } else { 
        $post_shortcode = get_post_meta( $post->ID, '_kad_post_gallery_shortcode', true ); 
        echo do_shortcode($post_shortcode); 
    }?>
</section>
<?php
/**
 * Template for displaying video in post excerpt area.
 */
global $post;
?>
<div class="videofit">
    <?php $video = get_post_meta( $post->ID, '_kad_post_video', true ); echo $video; ?>
</div>
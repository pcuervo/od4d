<?php
/**
 * Template for displaying shortcode in posts head area.
 */
global $post, $kt_feat_width;
$swidth = get_post_meta( $post->ID, '_kad_video_posthead_width', true );
	if (!empty($swidth)) {
		$slidewidth = $swidth;
	} else {
		$slidewidth = apply_filters('pinnacle_defualt_posthead_width', $kt_feat_width);
	} 
?>
 <section class="postfeat">
                <div class="videofit" style="max-width: <?php echo esc_attr($slidewidth);?>px; margin-left: auto; margin-right: auto;">
                    <?php  echo get_post_meta( $post->ID, '_kad_post_video', true ); ?>
                </div>
</section>
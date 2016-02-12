<?php
/**
 * Template for displaying a gallery grid in post excerpt area.
 */
global $post, $kt_post_with_sidebar;
if($kt_post_with_sidebar) {
	$largeimgsize = 440;
	$smallimgsize = 220;
} else {
	$largeimgsize = 440;
	$smallimgsize = 220;
}
?>
<div class="kad_post_grid kad-light-wp-gallery">
	<div class="kad_postgrid_wrap clearfix">
		<?php
        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
        if(!empty($image_gallery)) {
            $attachments = array_filter( explode( ',', $image_gallery ) );
            if ($attachments) {
                $i = 1;
                foreach ($attachments as $attachment) {
                    $attachment_url = wp_get_attachment_url($attachment , 'full');
                    $attachment_post = get_post( $attachment  );
                    if($i==3) {$image = aq_resize($attachment_url, $largeimgsize, $largeimgsize, true);} else {$image = aq_resize($attachment_url, $smallimgsize, $smallimgsize, true);}
                    if(empty($image)) {$image = $attachment_url;} 
                    	if($i==1 || $i == 4) { echo '<div class="side_post_gal">';} ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <a href="<?php the_permalink() ?>">
                                        <img src="<?php echo esc_attr($image); ?>" class="" alt="<?php esc_attr($attachment_post->post_excerpt);?>" />
                                    </a>
                                </div>
                                <?php if($i==2 || $i == 5) { echo '</div>';} 
                                    $i ++;
                               	if($i==6) break;
                    }
            }
        } ?>                                   
    </div>
</div>
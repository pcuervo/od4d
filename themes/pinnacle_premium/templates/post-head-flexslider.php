<?php
/**
 * Template for displaying post featured image.
 */
global $post, $kt_feat_width;
$swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true );
$height = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true );
	if (!empty($swidth)) {
		$slidewidth = $swidth;
	} else {
		$slidewidth = apply_filters('pinnacle_defualt_posthead_width', $kt_feat_width);
	} 
	if (!empty($height)) {
		$slideheight = $height; 
	} else {
		$slideheight = apply_filters('pinnacle_defualt_posthead_height', 400);
	}
	?>
 		<section class="postfeat">
          <?php
          if(function_exists('kt_create_flexslider')){
              $speed = 7000;
              $animationspeed = 400;
              $animation = "fade";
              $auto = "true";
              $initdelay = 0;
              $width = $slidewidth;
              $height = $slideheight;
              $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
              $link = 'lightbox';
              kt_create_flexslider($speed, $animationspeed, $animation, $auto, $initdelay, $width, $height, $image_gallery, $link);
          }
          ?>
        </section>
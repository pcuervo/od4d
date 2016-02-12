<?php
/**
 * Template for displaying carousel slider in a post head.
 */
global $post, $kt_feat_width;
$swidth = get_post_meta( $post->ID, '_kad_posthead_width', true );
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
          <div id="imageslider" class="loading">
            <div class="carousel_slider_outer fredcarousel fadein-carousel" style="overflow:hidden; max-width:<?php echo esc_attr($slidewidth);?>px; height: <?php echo esc_attr($slideheight);?>px; margin-left: auto; margin-right:auto;">
                <div class="carousel_slider kad-light-gallery initcarouselslider" data-carousel-container=".carousel_slider_outer" data-carousel-transition="600" data-carousel-height="<?php echo esc_attr($slideheight); ?>" data-carousel-auto="true" data-carousel-speed="9000" data-carousel-id="carouselslider_<?php echo esc_attr($post->ID);?>">
                    <?php $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                          if(!empty($image_gallery)) {
                              $attachments = array_filter( explode( ',', $image_gallery ) );
                                if ($attachments) {
                                  foreach ($attachments as $attachment) {
                                        $attachment_url = wp_get_attachment_url($attachment , 'full');
                                        $image = aq_resize($attachment_url, null, $slideheight, false, false);
                                        $caption = get_post($attachment)->post_excerpt;
                                    if(empty($image)) {$image = array($attachment_url,$slidewidth,$slideheight);} 
                                    echo '<div class="carousel_gallery_item" style="float:left; display: table; position: relative; text-align: center; margin: 0; width:auto; height:'.esc_attr($image[2]).'px;">';
                                    echo '<div class="carousel_gallery_item_inner" style="vertical-align: middle; display: table-cell;">';
                                    echo '<a href="'.esc_url($attachment_url).'" data-rel="lightbox" title="'.esc_attr($caption).'">';
                                    echo '<img src="'.esc_url($image[0]).'" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" itemprop="image" alt="'.esc_attr(get_post_field('post_excerpt', $attachment)).'"/>';
                                    echo '</a>'; ?>
                                    </div>
                                  </div>
                          <?php } } }?>
                    </div>
                    <div class="clearfix"></div>
                      <a id="prevport-carouselslider_<?php echo esc_attr($post->ID);?>" class="prev_carousel kt-icon-arrow-left" href="#"></a>
                      <a id="nextport-carouselslider_<?php echo esc_attr($post->ID);?>" class="next_carousel kt-icon-arrow-right" href="#"></a>
                  </div> 
          </div>   
        </section>
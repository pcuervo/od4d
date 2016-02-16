<?php
/**
 * Template for displaying a featured image in post excerpt area.
 */
global $post, $pinnacle,  $kt_post_with_sidebar;
if($kt_post_with_sidebar) {
    $kt_feat_width = 848;
} else {
    $kt_feat_width = 1170;
}
if (has_post_format( 'gallery' )) {
$swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true );
$height = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true ); 
} elseif (has_post_format( 'image' )) {
    $swidth = get_post_meta( $post->ID, '_kad_image_posthead_width', true );
    $height = "";
} else {
    $swidth = "";
    $height = "";
}

if (!empty($swidth)) {$slidewidth = $swidth;} else {$slidewidth = $kt_feat_width;}
if (!empty($height)) {$slideheight = $height;} else {$slideheight = 400;}
if(isset($pinnacle['postexcerpt_hard_crop']) && $pinnacle['postexcerpt_hard_crop'] == 1) {
    $hardcrop = true;
    $img_width = 'width="'.esc_attr($slidewidth).'"';
    $img_height = 'height="'.esc_attr($slideheight).'"';
} else {
    $hardcrop = false;
    $img_width = "";
    $img_height = "";
}
if (has_post_thumbnail( $post->ID ) ) {
   	$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full' ); 
    $thumbnailURL = $image_url[0];
    if($hardcrop) {
        $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);
    } else {
        $image = aq_resize($thumbnailURL,$slidewidth, false);
    }
	if(empty($image)) { $image = $thumbnailURL; } ?>
        <div class="col-md-12">
            <div class="imghoverclass img-margin-center" itemprop="image">
                <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" <?php echo esc_attr($img_width);?> <?php echo esc_attr($img_height);?> class="iconhover" style="display:block;">
                </a> 
        	</div>
        </div>
    <?php $image = null; $thumbnailURL = null; 
    } else {  
        $thumbnailURL = pinnacle_post_default_placeholder();
        if($hardcrop) {
            $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);
        } else {
            $image = aq_resize($thumbnailURL,$slidewidth, false);
        }
        if(empty($image)) { $image = $thumbnailURL; } ?>
        <div class="col-md-12">
            <div class="imghoverclass img-margin-center" itemprop="image">
                <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" <?php echo esc_attr($img_width);?> <?php echo esc_attr($img_height);?> class="iconhover" style="display:block;">
                </a> 
            </div>
        </div>
        <?php $image = null; $thumbnailURL = null; 
    } ?>
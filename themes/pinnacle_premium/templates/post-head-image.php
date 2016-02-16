<?php
/**
 * Template for displaying post featured image.
 */
global $post, $kt_feat_width;
if (has_post_format( 'gallery' )) {
$swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true ); 
} elseif (has_post_format( 'image' )) {
    $swidth = get_post_meta( $post->ID, '_kad_image_posthead_width', true );
}
if (!empty($swidth)) {
	$slidewidth = $swidth;
	} else {
		$slidewidth = $kt_feat_width;
	}
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'full' );
$image = aq_resize( $img_url, $slidewidth, null, true, false); //resize & crop the image
if(empty($image[0])) {$image[0] = $img_url; $image[1] = null; $image[2] = null;}
if($image) : ?>
	<section class="postfeat">
    	<div class="imghoverclass post-single-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
    		<a href="<?php echo esc_url($img_url); ?>" data-rel="lightbox" class="">
    			<img src="<?php echo esc_url($image[0]); ?>" itemprop="contentUrl" alt="<?php the_title(); ?>" />
                <meta itemprop="url" content="<?php echo esc_url($image[0]); ?>">
                <meta itemprop="width" content="<?php echo esc_attr($image[1])?>px">
                <meta itemprop="height" content="<?php echo esc_attr($image[2])?>px">
    		</a>
    	</div>
    </section>
<?php endif; ?>
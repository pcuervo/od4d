<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $pinnacle;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

$product_column = $woocommerce_loop['columns']; 
	if ($product_column == '3'){
		$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
		$productimgwidth = 400;
	} else if ($product_column == '5'){
		$itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; 
		$productimgwidth = 240;
	} else {
		$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
		$productimgwidth = 300;
	}

	// Extra post classes
	$classes = array();
	if(isset($pinnacle['shop_hide_action']) && $pinnacle['shop_hide_action'] == 1) {
		$classes[] = 'hidetheaction';
	}
	$classes[] = 'grid_item';
	$classes[] = 'product_item';
	$classes[] = 'clearfix';
	$classes[] = 'postclass';
	$classes[] = 'kad_product_fade_in';

	if(isset($pinnacle['product_img_resize']) && $pinnacle['product_img_resize'] == 0) {
		$resizeimage = 0;
	} else {
		$resizeimage = 1;
		$productimgheight = $productimgwidth;
	}?>
<div class="<?php echo esc_attr($itemsize);?> kad_product">
	<div <?php post_class( $classes ); ?>>
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<?php echo woocommerce_show_product_loop_sale_flash($post, $product); ?>
			<a href="<?php the_permalink(); ?>" class="product_item_link product_img_link">

		<?php /**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' ); ?> 

			<?php if ( $resizeimage == 1 ) {
				echo '<div class="kad-product-noflipper">';
					if ( has_post_thumbnail() ) {
						$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
						$product_image_url = $product_image[0]; 
						$image_product = aq_resize($product_image_url, $productimgwidth, $productimgheight, true);
		            	if(empty($image_product)) {$image_product = $product_image_url;} ?> 
	            	 	<img width="<?php echo esc_attr($productimgwidth);?>" height="<?php echo esc_attr($productimgheight);?>" src="<?php echo esc_attr($image_product);?>" class="attachment-shop_catalog wp-post-image" alt="<?php the_title();?>">
	           		<?php }
	           	echo '</div>';
			} else { 
				echo '<div class="kad-woo-image-size">';
				echo woocommerce_template_loop_product_thumbnail();
				echo '</div>';
         	} ?>
         	<div class="kad-action-case"></div>
            </a>
		    <div class="product_details_case clearfix">
				<div class="product_details">
					<a href="<?php the_permalink(); ?>" class="product_item_link product_title_link">
						<?php 
				/**
			 	* woocommerce_shop_loop_item_title hook
			 	*
			 	* @hooked woocommerce_template_loop_product_title - 10
			 	*/
				do_action( 'woocommerce_shop_loop_item_title' );
				?>
					</a>
					<div class="product_excerpt">
						<?php global $post; if ($post->post_excerpt){
							echo do_shortcode(wpautop(wptexturize($post->post_excerpt))); 
						} else {	
							the_excerpt();
							} ?>
					</div>
				</div>
		
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			</div>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

	</div>
</div>
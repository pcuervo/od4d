<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $pinnacle;

if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
	return;
?>
<?php if ($pinnacle['shop_rating'] == '1') { ?> 
	<?php if ( $rating_html = $product->get_rating_html() ) { ?>
		<a href="<?php the_permalink(); ?>"><?php echo $rating_html; ?></a>
	<?php } else { echo "<span class='notrated'>".__('not rated', 'pinnacle')."</span>"; ?>
	<?php } ?>
<?php } ?>
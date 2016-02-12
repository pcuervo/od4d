<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
	<?php get_header(); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<?php  global $pinnacle, $woocommerce_loop;  
 if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
 
			if (is_shop()) {
				if(isset($pinnacle['choose_shop_header'])) {$choose_shop_header = $pinnacle['choose_shop_header'];} else {$choose_shop_header = 'pagetitle';}
					if ($choose_shop_header == "rev") {
					get_template_part('templates/shop/rev', 'slider');
					}
					else if ($choose_shop_header == "flex") {
						get_template_part('templates/shop/flex', 'slider');
					}
					else if ($choose_shop_header == "carousel") {
						get_template_part('templates/shop/carousel', 'slider');
					}
					else if ($choose_shop_header == "cyclone") {
						get_template_part('templates/shop/cyclone', 'slider');
					}
					else if ($choose_shop_header == "ktslider") {
						get_template_part('templates/shop/kt', 'slider');
					} else if ($choose_shop_header == "none") {
						// do nothing //
					} else {
						get_template_part('templates/shop/shop', 'page-header');
					}
			} else if(is_product_category()) {
					$cat_term_id = get_queried_object()->term_id; $meta = get_option('product_cat_slider');
					if (empty($meta)) { $meta = array(); } if (!is_array($meta)) {$meta = (array) $meta;}
					$meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
					if(isset($meta['cat_short_slider'])) { 
						echo '<div class="sliderclass kad_cat_slider">'. do_shortcode($meta['cat_short_slider']). '</div>';
							if(kadence_display_archive_breadcrumbs()) {?>
							<div class="container bc_nomargin">
								<?php kadence_breadcrumbs(); ?> 
							</div>
							<?php } 
					} else {
						get_template_part('templates/archive', 'header');
					}
			 } else {
			 	get_template_part('templates/archive', 'header');
			 }
			 ?>

		<div id="content" class="container">
   		<div class="row">
      <div class="main <?php echo kadence_main_class(); ?>" role="main">

      	<div class="kad-shop-top">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<?php woocommerce_result_count(); ?>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<?php woocommerce_catalog_ordering(); ?>
					</div>
				</div>
		</div>
		<?php if(is_shop()){ ?>
		<div class="clearfix">
		<?php do_action( 'woocommerce_archive_description' ); ?>
		</div>
		<?php } ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
			<?php global $pinnacle; $shop_filter = $pinnacle['shop_filter']; 
			 $cat_filter = $pinnacle['cat_filter']; 
			 if(!empty($pinnacle['filter_all_text'])) {$alltext = $pinnacle['filter_all_text'];} else {$alltext = __('All', 'pinnacle');}
			 if(!empty($pinnacle['shop_filter_text'])) {$shopfiltertext = $pinnacle['shop_filter_text'];} else {$shopfiltertext = __('Filter Products', 'pinnacle');}
	  		if (is_shop() && $shop_filter == 1 && !is_search()) { ?>
      		<section id="options" class="clearfix">
			<?php 
			$categories = get_terms('product_cat');
					$count = count($categories);
						echo '<a class="filter-trigger headerfont" data-toggle="collapse" data-target=".filter-collapse"><i class="icon-tags"></i> '.$shopfiltertext.'</a>';
						echo '<ul id="filters" class="clearfix option-set filter-collapse">';
						echo '<li class="postclass"><a href="#" data-filter="*" title="'.esc_attr($alltext).'" class="selected"><h5>'.$alltext.'</h5><div class="arrow-up"></div></a></li>';
						 if ( $count > 0 ){
							foreach ($categories as $category){ 
							$termname = strtolower($category->slug);
							$termname = preg_replace("/[^a-zA-Z 0-9]+/", " ", $termname);
							$termname = str_replace(' ', '-', $termname);	
							echo '<li class="postclass"><a href="#" data-filter=".'.esc_attr($termname).'" title="" rel="'.esc_attr($termname).'"><h5>'.$category->name.'</h5><div class="arrow-up"></div></a></li>';
								}
				 		}
				 		echo "</ul>"; ?>
			</section>
            <?php } else if (is_product_category() && $cat_filter == 1) { ?>
      		<section id="options" class="clearfix">
			<?php
			global $wp_query;
				// get the query object
					$cat_obj = $wp_query->get_queried_object();
					$product_cat_ID  = $cat_obj->term_id;
					$termtypes = array( 'child_of' => $product_cat_ID,);
					$categories = get_terms('product_cat', $termtypes);
					$count = count($categories);
					if ( $count > 0 ){
						echo '<a class="filter-trigger headerfont" data-toggle="collapse" data-target=".filter-collapse"><i class="icon-tags"></i> '.$shopfiltertext.'</a>';
						echo '<ul id="filters" class="clearfix option-set filter-collapse">';
						echo '<li class="postclass"><a href="#" data-filter="*" title="'.$alltext.'" class="selected"><h5>'.$alltext.'</h5><div class="arrow-up"></div></a></li>';
							foreach ($categories as $category){ 
							$termname = strtolower($category->slug);
							$termname = preg_replace("/[^a-zA-Z 0-9]+/", " ", $termname);
							$termname = str_replace(' ', '-', $termname);
							echo '<li class="postclass"><a href="#" data-filter=".'.$termname.'" title="" rel="'.$termname.'"><h5>'.$category->name.'</h5><div class="arrow-up"></div></a></li>';
								}
						echo "</ul>"; 
				 	} ?>
			</section>
            <?php } ?>
            <?php global $pinnacle; if(isset($pinnacle['product_fitrows']) && $pinnacle['product_fitrows'] == 1) {$style = 'fitRows';} else {$style = 'masonry';} 
            if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}?>
            <div class="clearfix <?php echo kadence_category_layout_css(); ?> rowtight product_category_padding init-isotope" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".kad_product" data-iso-style="<?php echo esc_attr($style);?>" data-iso-filter="false"> 
            	<?php global $woocommerce, $woocommerce_loop;
            	 if ( empty( $woocommerce_loop['columns'] ) ) $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
        			woocommerce_product_subcategories();
            	?>
            </div>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	  <?php get_footer(); ?>
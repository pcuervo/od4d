<div class="home-product home-margin carousel_outerrim home-padding kad-animation" data-animation="fade-in" data-delay="0">
		<?php global $pinnacle; if(!empty($pinnacle['product_best_title'])) {$product_best_title = $pinnacle['product_best_title'];} else {$product_best_title = __('Best Selling Products', 'pinnacle');}
			if(!empty($pinnacle['home_product_best_column'])) {$product_tcolumn = $pinnacle['home_product_best_column'];} else {$product_tcolumn = '4';}
				if ($product_tcolumn == '2') {$md = 2; $sm = 2; $xs = 1; $ss = 1;} 
		        else if ($product_tcolumn == '3'){ $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
	            else if ($product_tcolumn == '6'){ $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
		        else if ($product_tcolumn == '5'){ $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
		        else { $md = 4; $sm = 3; $xs = 2; $ss = 1;}

		        $sxl = $md; 
		        $xl = $md;
		if(!empty($pinnacle['home_product_best_count'])) {$hp_probcount = $pinnacle['home_product_best_count'];} else {$hp_probcount = '6';}
		if(!empty($pinnacle['home_product_best_speed'])) {$hp_bestspeed = $pinnacle['home_product_best_speed'].'000';} else {$hp_bestspeed = '9000';}
		if(isset($pinnacle['product_shop_style'])) {$product_shop_style = $pinnacle['product_shop_style'];} else {$product_shop_style = 'kad-simple-shop';}
		if(isset($pinnacle['home_product_best_scroll']) && $pinnacle['home_product_best_scroll'] == 'all' ) {$hp_bestscroll = '';} else {$hp_bestscroll = '1';}?>
		<div class="clearfix"><h3 class="hometitle"><?php echo $product_best_title; ?></h3></div>
		<div class="fredcarousel">
		<div id="hpb_carouselcontainer" class="rowtight fadein-carousel">
		<div id="home-product-best-carousel" class="products initcaroufedsel caroufedselclass <?php echo esc_attr($product_shop_style); ?>  clearfix" data-carousel-container="#hpb_carouselcontainer" data-carousel-transition="700" data-carousel-scroll="<?php echo esc_attr($hp_bestscroll); ?>" data-carousel-auto="true" data-carousel-speed="<?php echo esc_attr($hp_bestspeed); ?>" data-carousel-id="product_best" data-carousel-sxl="<?php echo esc_attr($sxl);?>" data-carousel-xl="<?php echo esc_attr($xl);?>" data-carousel-md="<?php echo esc_attr($md);?>" data-carousel-sm="<?php echo esc_attr($sm);?>" data-carousel-xs="<?php echo esc_attr($xs);?>" data-carousel-ss="<?php echo esc_attr($ss);?>">
        <?php global $woocommerce_loop;
        		$temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array(
					'post_type' => 'product',
					 'meta_key'=> 'total_sales',
		            'orderby' => 'meta_value_num',
					'post_status' => 'publish',
					'posts_per_page' => $hp_probcount));
					$woocommerce_loop['columns'] = $product_tcolumn;
					if ( $wp_query ) : 
							 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
						
					<?php endif; ?>
                                    
                    <?php 
                      $wp_query = null; 
                      $wp_query = $temp;  // Reset
                    ?>
                    <?php wp_reset_query(); ?>
		</div>
		</div>
		<div class="clearfix"></div>
		            <a id="prevport-product_best" class="prev_carousel kt-icon-arrow-left" href="#"></a>
					<a id="nextport-product_best" class="next_carousel kt-icon-arrow-right" href="#"></a>
		</div>
	</div>
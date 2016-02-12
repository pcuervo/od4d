    <div id="blog_carousel_container" class="carousel_outerrim">
        <?php global $post, $postcolumn, $pinnacle; 
        $text = get_post_meta( $post->ID, '_kad_blog_carousel_title', true ); 
        if(!empty($text)) { 
        	echo '<h3 class="sectiontitle">'.$text.'</h3>'; 
        } else {
    		echo '<h3 class="sectiontitle">';
    		echo apply_filters( 'similarposts_title', __('Similar Posts', 'pinnacle') );
    		echo '</h3>';
    		} ?>
            <div class="blog-carouselcase fredcarousel">
            <?php 
    	if(isset($pinnacle['post_carousel_columns']) ) {
      			$postcolumn = $pinnacle['post_carousel_columns'];
      		} else {
      			$postcolumn = '3';
      		}
    	if ($postcolumn == '4') {
    		$itemsize = 'tcol-md-3 tcol-sm-3 tcol-xs-4 tcol-ss-12';
    		$sxl = 4;
    		$xl = 4;
    		$md = 4;
    		$sm = 3;
    		$xs = 2;
    		$ss = 1; 
    	} else if($postcolumn == '5') {
    		$itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6';
    		$sxl = 5;
    		$xl = 5;
    		$md = 5;
    		$sm = 4;
    		$xs = 3;
    		$ss = 2;
    	} else if($postcolumn == '6') {
    		$itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6';
    		$sxl = 6;
    		$xl = 6;
    		$md = 6;
    		$sm = 4;
    		$xs = 3;
    		$ss = 2;
    	} else {
    		$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';
    		$sxl = 3;
    		$xl = 3;
    		$md = 3;
    		$sm = 3;
    		$xs = 2;
    		$ss = 1;
    	} ?>
			<div id="carouselcontainer-blog" class="rowtight">
    		<div id="blog_carousel" class="blog_carousel initcaroufedsel clearfix" data-carousel-container="#carouselcontainer-blog" data-carousel-transition="400" data-carousel-scroll="1" data-carousel-auto="true" data-carousel-speed="9000" data-carousel-id="blog" data-carousel-sxl="<?php echo esc_attr($sxl);?>" data-carousel-xl="<?php echo esc_attr($xl);?>" data-carousel-md="<?php echo esc_attr($md);?>" data-carousel-sm="<?php echo esc_attr($sm);?>" data-carousel-xs="<?php echo esc_attr($xs);?>" data-carousel-ss="<?php echo esc_attr($ss);?>">
      		<?php $categories = get_the_category($post->ID);
					if ($categories) {
						$category_ids = array();
						foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; 
					}
					$temp = $wp_query; 
				  	$wp_query = null; 
				  	$wp_query = new WP_Query();
				  	$wp_query->query(array('category__in' => $category_ids,'orderby' => 'rand','post__not_in' => array($post->ID),'posts_per_page'=>8));
					if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                	<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
							<?php get_template_part('templates/content', 'post-grid-carousel');?>
					</div>
					<?php endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle'); ?></li>
					<?php endif; 
				$wp_query = null; 
			  	$wp_query = $temp;  // Reset
				wp_reset_query(); ?>								
				</div>
     		<div class="clearfix"></div>
	            <a id="prevport-blog" class="prev_carousel kt-icon-arrow-left" href="#"></a>
				<a id="nextport-blog" class="next_carousel kt-icon-arrow-right" href="#"></a>
            </div>
        </div>
</div><!-- blog_carousel_container-->			